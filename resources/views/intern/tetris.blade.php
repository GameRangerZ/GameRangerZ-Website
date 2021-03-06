@extends('layouts.intern')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('flash-message')
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row justify-content-between">
                        <h4 class="card-title mb-1">Tetris</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-8">
                            <style>
                                #canvas {
                                    display: inline-block;
                                    vertical-align: top;
                                    background: #0A0C0F;
                                }

                                #menu {
                                    display: inline-block;
                                    vertical-align: top;
                                    position: relative;
                                }

                                #menu p {
                                    margin: 0.5em 0;
                                    text-align: center;
                                }

                                #upcoming {
                                    display: block;
                                    margin: 20px auto;
                                    background-color: #383f51;
                                    border-radius: 10px;
                                }

                                #hold {
                                    display: block;
                                    margin: 20px auto;
                                    background-color: #383f51;
                                    border-radius: 10px;
                                }

                                #score {
                                    color: white;
                                    font-weight: bold;
                                    vertical-align: middle;
                                }

                                #rows {
                                    color: white;
                                    font-weight: bold;
                                    vertical-align: middle;
                                }

                                #tetris {
                                    width: 100%;
                                    height: 600px;
                                }

                                #menu {
                                    width: 300px;
                                    height: 600px;
                                }

                                #upcoming {
                                    width: 150px;
                                    height: 150px;
                                }

                                #hold {
                                    width: 150px;
                                    height: 150px;
                                }

                                #canvas {
                                    width: 300px;
                                    height: 600px;
                                }
                            </style>
                            <div id="tetris">
                                <div id="menu">
                                    <p id="start"><a class="btn btn-primary btn-lg" href="javascript:play();">Spiel
                                            starten</a></p>
                                    <p>
                                        <canvas id="upcoming"></canvas>
                                        <canvas id="hold"></canvas>
                                    </p>
                                    <p>Punkte <span id="score">00000</span></p>
                                    <p>Reihen <span id="rows">0</span></p>
                                </div>
                                <canvas id="canvas">
                                    Sorry, this example cannot be run because your browser does not support the &lt;canvas&gt;
                                    element
                                </canvas>
                            </div>

                            <script>

                                //-------------------------------------------------------------------------
                                // base helper methods
                                //-------------------------------------------------------------------------

                                function get(id) {
                                    return document.getElementById(id);
                                }

                                function hide(id) {
                                    get(id).style.visibility = 'hidden';
                                }

                                function show(id) {
                                    get(id).style.visibility = null;
                                }

                                function html(id, html) {
                                    get(id).innerHTML = html;
                                }

                                function timestamp() {
                                    return new Date().getTime();
                                }

                                function random(min, max) {
                                    return (min + (Math.random() * (max - min)));
                                }

                                function randomChoice(choices) {
                                    return choices[Math.round(random(0, choices.length - 1))];
                                }

                                const hex2rgba = (hex, alpha = 1) => {
                                    const [r, g, b] = hex.match(/\w\w/g).map(x => parseInt(x, 16));
                                    return `rgba(${r},${g},${b},${alpha})`;
                                };

                                if (!window.requestAnimationFrame) { // http://paulirish.com/2011/requestanimationframe-for-smart-animating/
                                    window.requestAnimationFrame = window.webkitRequestAnimationFrame ||
                                        window.mozRequestAnimationFrame ||
                                        window.oRequestAnimationFrame ||
                                        window.msRequestAnimationFrame ||
                                        function (callback, element) {
                                            window.setTimeout(callback, 1000 / 60);
                                        }
                                }

                                //-------------------------------------------------------------------------
                                // game constants
                                //-------------------------------------------------------------------------

                                var KEY = {
                                        ESC: 27,
                                        SPACE: 32,
                                        ENTER: 13,
                                        LEFT: 37,
                                        UP: 38,
                                        RIGHT: 39,
                                        DOWN: 40,
                                        C: 67,
                                        Y: 89
                                    },
                                    DIR = {
                                        UP: 0,
                                        RIGHT: 1,
                                        DOWN: 2,
                                        LEFT: 3,
                                        MIN: 0,
                                        MAX: 3,
                                        DROP: 4,
                                        SWAP: 5,
                                        REVERSE: 6
                                    },
                                    canvas = get('canvas'),
                                    ctx = canvas.getContext('2d'),
                                    ucanvas = get('upcoming'),
                                    uctx = ucanvas.getContext('2d'),
                                    hcanvas = get('hold'),
                                    hctx = hcanvas.getContext('2d'),
                                    speed = {start: 0.6, decrement: 0.005, min: 0.1}, // how long before piece drops by 1 row (seconds)
                                    TetrisBlockWidth = 10, // width of tetris court (in blocks)
                                    TetrisBlockHeight = 20, // height of tetris court (in blocks)
                                    UpcomingBlockSize = 5;  // width/height of upcoming preview (in blocks)

                                //-------------------------------------------------------------------------
                                // game variables (initialized during reset)
                                //-------------------------------------------------------------------------

                                var dx, dy,        // pixel size of a single tetris block
                                    blocks,        // 2 dimensional array (nx*ny) representing tetris court - either empty block or occupied by a 'piece'
                                    actions,       // queue of user actions (inputs)
                                    playing,       // true|false - game is in progress
                                    TimeSinceStart,// time since starting this game
                                    current,       // the current piece
                                    ghost,         // the ghost piece
                                    next,          // the next piece
                                    hold,          // the hold piece
                                    score,         // the current score
                                    vscore,        // the currently displayed score (it catches up to score in small chunks - like a spinning slot machine)
                                    rows,          // number of completed rows in the current game
                                    step,          // how long before current piece drops by 1 row
                                    NoSwap;        // Flag if Blocks where swapped

                                //-------------------------------------------------------------------------
                                // tetris pieces
                                //
                                // blocks: each element represents a rotation of the piece (0, 90, 180, 270)
                                //         each element is a 16 bit integer where the 16 bits represent
                                //         a 4x4 set of blocks, e.g. j.blocks[0] = 0x44C0
                                //
                                //             0100 = 0x4 << 3 = 0x4000
                                //             0100 = 0x4 << 2 = 0x0400
                                //             1100 = 0xC << 1 = 0x00C0
                                //             0000 = 0x0 << 0 = 0x0000
                                //                               ------
                                //                               0x44C0
                                //
                                //-------------------------------------------------------------------------

                                var i = {size: 4, blocks: [0x0F00, 0x2222, 0x00F0, 0x4444], color: '#03a9f4'};
                                var j = {size: 3, blocks: [0x44C0, 0x8E00, 0x6440, 0x0E20], color: '#3f51b5'};
                                var l = {size: 3, blocks: [0x4460, 0x0E80, 0xC440, 0x2E00], color: '#f44336'};
                                var o = {size: 2, blocks: [0xCC00, 0xCC00, 0xCC00, 0xCC00], color: '#ffeb3b'};
                                var s = {size: 3, blocks: [0x06C0, 0x8C40, 0x6C00, 0x4620], color: '#4caf50'};
                                var t = {size: 3, blocks: [0x0E40, 0x4C40, 0x4E00, 0x4640], color: '#673ab7'};
                                var z = {size: 3, blocks: [0x0C60, 0x4C80, 0xC600, 0x2640], color: '#ff1744'};

                                //------------------------------------------------
                                // do the bit manipulation and iterate through each
                                // occupied block (x,y) for a given piece
                                //------------------------------------------------
                                function eachblock(type, x, y, dir, fn) {
                                    var bit, result, row = 0, col = 0, blocks = type.blocks[dir];
                                    for (bit = 0x8000; bit > 0; bit = bit >> 1) {
                                        if (blocks & bit) {
                                            fn(x + col, y + row);
                                        }
                                        if (++col === 4) {
                                            col = 0;
                                            ++row;
                                        }
                                    }
                                }

                                //-----------------------------------------------------
                                // check if a piece can fit into a position in the grid
                                //-----------------------------------------------------
                                function occupied(type, x, y, dir) {
                                    var result = false
                                    eachblock(type, x, y, dir, function (x, y) {
                                        if ((x < 0) || (x >= TetrisBlockWidth) || (y < 0) || (y >= TetrisBlockHeight) || getBlock(x, y))
                                            result = true;
                                    });
                                    return result;
                                }

                                function unoccupied(type, x, y, dir) {
                                    return !occupied(type, x, y, dir);
                                }

                                //-----------------------------------------
                                // start with 4 instances of each piece and
                                // pick randomly until the 'bag is empty'
                                //-----------------------------------------
                                var pieces = [];

                                function randomPiece() {
                                    if (pieces.length == 0)
                                        pieces = [i, i, i, i, j, j, j, j, l, l, l, l, o, o, o, o, s, s, s, s, t, t, t, t, z, z, z, z];
                                    var type = pieces.splice(random(0, pieces.length - 1), 1)[0];
                                    return {
                                        type: type,
                                        dir: DIR.UP,
                                        x: Math.round(random(0, TetrisBlockWidth - type.size)),
                                        y: 0
                                    };
                                }


                                //-------------------------------------------------------------------------
                                // GAME LOOP
                                //-------------------------------------------------------------------------

                                function run() {

                                    addEvents(); // attach keydown and resize events

                                    var last = now = timestamp();

                                    function frame() {
                                        now = timestamp();
                                        update(Math.min(1, (now - last) / 1000.0)); // using requestAnimationFrame have to be able to handle large delta's caused when it 'hibernates' in a background or non-visible tab
                                        draw();
                                        last = now;
                                        requestAnimationFrame(frame, canvas);
                                    }

                                    resize(); // setup all our sizing information
                                    reset();  // reset the per-game variables
                                    frame();  // start the first frame

                                }

                                function addEvents() {
                                    document.addEventListener('keydown', keydown, false);
                                    window.addEventListener('resize', resize, false);
                                }

                                function resize(event) {
                                    canvas.width = canvas.clientWidth;  // set canvas logical size equal to its physical size
                                    canvas.height = canvas.clientHeight; // (ditto)
                                    ucanvas.width = ucanvas.clientWidth;
                                    ucanvas.height = ucanvas.clientHeight;
                                    hcanvas.width = hcanvas.clientWidth;
                                    hcanvas.height = hcanvas.clientHeight;
                                    dx = canvas.width / TetrisBlockWidth; // pixel size of a single tetris block
                                    dy = canvas.height / TetrisBlockHeight; // (ditto)
                                    invalidate();
                                    invalidateNext();
                                    invalidateHold();
                                }

                                function keydown(ev) {
                                    var handled = false;
                                    if (playing) {
                                        switch (ev.keyCode) {
                                            case KEY.LEFT:
                                                actions.push(DIR.LEFT);
                                                handled = true;
                                                break;
                                            case KEY.RIGHT:
                                                actions.push(DIR.RIGHT);
                                                handled = true;
                                                break;
                                            case KEY.UP:
                                                actions.push(DIR.UP);
                                                handled = true;
                                                break;
                                            case KEY.DOWN:
                                                actions.push(DIR.DOWN);
                                                handled = true;
                                                break;
                                            case KEY.SPACE:
                                                actions.push(DIR.DROP);
                                                handled = true;
                                                break;
                                            case KEY.C:
                                                actions.push(DIR.SWAP);
                                                handled = true;
                                                break;
                                            case KEY.Y:
                                                actions.push(DIR.REVERSE);
                                                handled = true;
                                                break;
                                            case KEY.ESC:
                                                lose();
                                                handled = true;
                                                break;
                                        }
                                    } else if (ev.keyCode == KEY.ENTER) {
                                        play();
                                        handled = true;
                                    }
                                    if (handled)
                                        ev.preventDefault(); // prevent arrow keys from scrolling the page (supported in IE9+ and all other browsers)
                                }

                                //-------------------------------------------------------------------------
                                // GAME LOGIC
                                //-------------------------------------------------------------------------

                                function play() {
                                    hide('start');
                                    reset();
                                    playing = true;
                                }

                                function lose() {
                                    show('start');
                                    setVisualScore();
                                    playing = false;
                                    $.ajax({
                                        url: '{{route('tetris.submit')}}',
                                        type: 'post', // performing a POST request
                                        data: {
                                            "_token": $('#token').val(),
                                            score: score // will be accessible in $_POST['data1']
                                        },
                                        success: function (data) {
                                            console.log("showing new scoreboard")
                                            if (parseInt($('#myscore').text()) < score) {
                                                $('#myscore').html(score);
                                            }
                                            $('#tries').html(parseInt($('#tries').text()) + 1);
                                            jQuery("#leaderboard").fadeOut(100, function () {
                                                jQuery(this).html(data);
                                            }).fadeIn(1000);
                                        }
                                    });
                                }

                                function setVisualScore(n) {
                                    vscore = n || score;
                                    invalidateScore();
                                }

                                function setScore(n) {
                                    score = n;
                                    setVisualScore(n);
                                }

                                function addScore(n) {
                                    score = score + n;
                                }

                                function clearScore() {
                                    setScore(0);
                                }

                                function clearHold() {
                                    hold = null;
                                    NoSwap = true;
                                }


                                function clearRows() {
                                    setRows(0);
                                }

                                function setRows(n) {
                                    rows = n;
                                    step = Math.max(speed.min, speed.start - (speed.decrement * rows));
                                    invalidateRows();
                                }

                                function addRows(n) {
                                    setRows(rows + n);
                                }

                                function getBlock(x, y) {
                                    return (blocks && blocks[x] ? blocks[x][y] : null);
                                }

                                function setBlock(x, y, type) {
                                    blocks[x] = blocks[x] || [];
                                    blocks[x][y] = type;
                                    invalidate();
                                }

                                function clearBlocks() {
                                    blocks = [];
                                    invalidate();
                                }

                                function clearActions() {
                                    actions = [];
                                }

                                function setCurrentPiece(piece) {
                                    current = piece || randomPiece();
                                    invalidate();
                                }

                                function setNextPiece(piece) {
                                    next = piece || randomPiece();
                                    invalidateNext();
                                }

                                function setHoldPiece(piece) {
                                    hold = piece;
                                    invalidateHold();
                                }

                                function swapHold() {
                                    if (NoSwap) {
                                        NoSwap = false;
                                        if (hold) {
                                            //we have a piece
                                            temp = current;
                                            setCurrentPiece(hold);
                                            setHoldPiece(temp);
                                        } else {
                                            setHoldPiece(current);
                                            setCurrentPiece();
                                        }
                                        hold.y = 0;
                                        hold.x = Math.round(random(0, TetrisBlockWidth - hold.type.size));
                                    }
                                }

                                function reset() {
                                    TimeSinceStart = 0;
                                    clearActions();
                                    clearBlocks();
                                    clearRows();
                                    clearScore();
                                    clearHold();
                                    setCurrentPiece(next);
                                    setNextPiece();
                                }

                                function update(idt) {
                                    if (playing) {
                                        if (vscore < score)
                                            setVisualScore(vscore + 1);
                                        handle(actions.shift());
                                        TimeSinceStart = TimeSinceStart + idt;
                                        if (TimeSinceStart > step) {
                                            TimeSinceStart = TimeSinceStart - step;
                                            drop();
                                        }
                                    }
                                }

                                function handle(action) {
                                    switch (action) {
                                        case DIR.LEFT:
                                            move(DIR.LEFT);
                                            break;
                                        case DIR.RIGHT:
                                            move(DIR.RIGHT);
                                            break;
                                        case DIR.UP:
                                            rotate();
                                            break;
                                        case DIR.DOWN:
                                            drop();
                                            break;
                                        case DIR.DROP:
                                            quickdrop();
                                            break;
                                        case DIR.SWAP:
                                            swapHold();
                                            break;
                                        case DIR.REVERSE:
                                            reverse_rotate();
                                            break;
                                    }
                                }

                                function move(dir) {
                                    var x = current.x, y = current.y;
                                    switch (dir) {
                                        case DIR.RIGHT:
                                            x = x + 1;
                                            break;
                                        case DIR.LEFT:
                                            x = x - 1;
                                            break;
                                        case DIR.DOWN:
                                            y = y + 1;
                                            break;
                                    }
                                    if (unoccupied(current.type, x, y, current.dir)) {
                                        current.x = x;
                                        current.y = y;
                                        invalidate();
                                        return true;
                                    } else {
                                        return false;
                                    }
                                }

                                function moveGhostDown() {
                                    hasSpace = true;
                                    var x = ghost.x, y = ghost.y;
                                    while (hasSpace) {
                                        y = y + 1;
                                        if (unoccupied(ghost.type, x, y, ghost.dir)) {
                                            ghost.y = y;
                                        } else {
                                            hasSpace = false;
                                        }
                                    }
                                }

                                function rotate() {
                                    var newdir = (current.dir == DIR.MAX ? DIR.MIN : current.dir + 1);
                                    if (unoccupied(current.type, current.x, current.y, newdir)) {
                                        current.dir = newdir;
                                        invalidate();
                                    }
                                }

                                function reverse_rotate() {
                                    var newdir = (current.dir == DIR.MIN ? DIR.MAX : current.dir - 1);
                                    if (unoccupied(current.type, current.x, current.y, newdir)) {
                                        current.dir = newdir;
                                        invalidate();
                                    }
                                }

                                function drop() {
                                    if (!move(DIR.DOWN)) {
                                        addScore(10);
                                        dropPiece();
                                        removeLines();
                                        setCurrentPiece(next);
                                        setNextPiece(randomPiece());
                                        NoSwap = true;
                                        clearActions();
                                        if (occupied(current.type, current.x, current.y, current.dir)) {
                                            lose();
                                        }
                                    }
                                }

                                function quickdrop() {
                                    hasSpace = true;
                                    while (hasSpace) {
                                        if (!move(DIR.DOWN)) {
                                            hasSpace = false;
                                            addScore(10);
                                            dropPiece();
                                            removeLines();
                                            setCurrentPiece(next);
                                            setNextPiece(randomPiece());
                                            clearActions();
                                            NoSwap = true;
                                            if (occupied(current.type, current.x, current.y, current.dir)) {
                                                lose();
                                            }
                                        }
                                    }
                                }

                                function dropPiece() {
                                    eachblock(current.type, current.x, current.y, current.dir, function (x, y) {
                                        setBlock(x, y, current.type);
                                    });
                                }

                                function removeLines() {
                                    var x, y, complete, n = 0;
                                    // 20..1
                                    for (y = TetrisBlockHeight; y > 0; --y) {
                                        complete = true;
                                        //0..9
                                        for (x = 0; x < TetrisBlockWidth; ++x) {
                                            if (!getBlock(x, y)) {
                                                complete = false;
                                            }
                                        }
                                        if (complete) {
                                            removeLine(y);
                                            y = y + 1; // recheck same line because of copy
                                            n++;
                                        }
                                    }
                                    if (n > 0) {
                                        addRows(n);
                                        addScore(100 * Math.pow(2, n - 1)); // 1: 100, 2: 200, 3: 400, 4: 800
                                    }
                                }

                                //Removes Line and copys above one
                                function removeLine(n) {
                                    var x, y;
                                    //n..0
                                    for (y = n; y >= 0; --y) {
                                        //0..9
                                        for (x = 0; x < TetrisBlockWidth; ++x) {
                                            setBlock(x, y, (y == 0) ? null : getBlock(x, y - 1));
                                        }
                                    }
                                }

                                //-------------------------------------------------------------------------
                                // RENDERING
                                //-------------------------------------------------------------------------

                                var invalid = {};

                                function invalidate() {
                                    invalid.court = true;
                                }

                                function invalidateNext() {
                                    invalid.next = true;
                                }

                                function invalidateHold() {
                                    invalid.hold = true;
                                }

                                function invalidateScore() {
                                    invalid.score = true;
                                }

                                function invalidateRows() {
                                    invalid.rows = true;
                                }

                                function draw() {
                                    ctx.save();
                                    ctx.lineWidth = 1;
                                    ctx.translate(0.5, 0.5); // for crisp 1px black lines
                                    drawCourt();
                                    drawNext();
                                    drawHold();
                                    drawScore();
                                    drawRows();
                                    ctx.restore();
                                }

                                function drawCourt() {
                                    if (invalid.court) {
                                        ctx.clearRect(0, 0, canvas.width, canvas.height);
                                        if (playing) {
                                            ghost = Object.assign({}, current);
                                            drawPiece(ctx, current.type, current.x, current.y, current.dir, true);
                                            moveGhostDown();
                                            drawGhost(ctx, ghost.type, ghost.x, ghost.y, ghost.dir);
                                        }
                                        var x, y, block;
                                        for (y = 0; y < TetrisBlockHeight; y++) {
                                            for (x = 0; x < TetrisBlockWidth; x++) {
                                                if (block = getBlock(x, y))
                                                    drawBlock(ctx, x, y, block.color);
                                            }
                                        }
                                        ctx.strokeRect(0, 0, TetrisBlockWidth * dx - 1, TetrisBlockHeight * dy - 1); // court boundary
                                        invalid.court = false;
                                    }
                                }

                                function drawNext() {
                                    if (invalid.next) {
                                        var padding = (UpcomingBlockSize - next.type.size) / 2; // half-arsed attempt at centering next piece display
                                        uctx.save();
                                        uctx.translate(0.5, 0.5);
                                        uctx.clearRect(0, 0, UpcomingBlockSize * dx, UpcomingBlockSize * dy);
                                        uctx.lineWidth = 1;
                                        drawPiece(uctx, next.type, padding, padding, next.dir);
                                        uctx.strokeStyle = 'black';
                                        uctx.strokeRect(0, 0, UpcomingBlockSize * dx - 1, UpcomingBlockSize * dy - 1);
                                        uctx.restore();
                                        uctx.font = "30px Calibri";
                                        uctx.fillStyle = "#fff";
                                        uctx.textAlign = "center";
                                        uctx.lineWidth = 3;
                                        uctx.strokeText("Next", ucanvas.width / 2, 25);
                                        uctx.fillText("Next", ucanvas.width / 2, 25);
                                        invalid.next = false;
                                    }
                                }

                                function drawHold() {
                                    if (invalid.hold) {

                                        hctx.save();
                                        hctx.translate(0.5, 0.5);
                                        hctx.clearRect(0, 0, UpcomingBlockSize * dx, UpcomingBlockSize * dy);
                                        if (hold) {
                                            var padding = (UpcomingBlockSize - hold.type.size) / 2; // half-arsed attempt at centering next piece display
                                            hctx.lineWidth = 1;
                                            drawPiece(hctx, hold.type, padding, padding, hold.dir);
                                            hctx.strokeStyle = 'black';
                                            hctx.strokeRect(0, 0, UpcomingBlockSize * dx - 1, UpcomingBlockSize * dy - 1);
                                        }
                                        hctx.restore();
                                        hctx.font = "30px Calibri";
                                        hctx.fillStyle = "#fff";
                                        hctx.textAlign = "center";
                                        hctx.lineWidth = 3;
                                        hctx.strokeText("Hold", ucanvas.width / 2, 25);
                                        hctx.fillText("Hold", ucanvas.width / 2, 25);
                                        invalid.hold = false;
                                    }
                                }

                                function drawScore() {
                                    if (invalid.score) {
                                        html('score', ("00000" + Math.floor(vscore)).slice(-5));
                                        invalid.score = false;
                                    }
                                }

                                function drawRows() {
                                    if (invalid.rows) {
                                        html('rows', rows);
                                        invalid.rows = false;
                                    }
                                }

                                function drawPiece(ctx, type, x, y, dir) {
                                    eachblock(type, x, y, dir, function (x, y) {
                                        drawBlock(ctx, x, y, type.color);
                                    });
                                }

                                function drawGhost(ctx, type, x, y, dir) {
                                    eachblock(type, x, y, dir, function (x, y) {
                                        drawBlock(ctx, x, y, hex2rgba(type.color, 0.1));
                                    });
                                }

                                function drawBlock(ctx, x, y, color) {
                                    ctx.fillStyle = color;
                                    ctx.fillRect(x * dx, y * dy, dx, dy);
                                    ctx.strokeRect(x * dx, y * dy, dx, dy)
                                }

                                //-------------------------------------------------------------------------
                                // FINALLY, lets run the game
                                //-------------------------------------------------------------------------

                                run();

                            </script>
                        </div>
                        <div class="col-4">
                            <div class="d-flex flex-row justify-content-between">
                                <h4 class="card-title mb-1">Deine Statistik</h4>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="preview-list">
                                        <div class="preview-item border-bottom">
                                            <div class="preview-thumbnail">
                                                <div class="preview-icon bg-info rounded-circle">
                                                    <i class="mdi mdi-trophy"></i>
                                                </div>
                                            </div>
                                            <div class="preview-item-content d-sm-flex flex-grow">
                                                <div class="flex-grow">
                                                    <h6 class="preview-subject">Highscore</h6>
                                                </div>
                                                <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                    <p class="text-muted" id="myscore">
                                                        @if($personalscore->count() > 0)
                                                            {{$personalscore->max('score')}}
                                                        @else
                                                            0
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="preview-list">
                                        <div class="preview-item">
                                            <div class="preview-thumbnail">
                                                <div class="preview-icon bg-info rounded-circle">
                                                    <i class="mdi mdi-repeat"></i>
                                                </div>
                                            </div>
                                            <div class="preview-item-content d-sm-flex flex-grow">
                                                <div class="flex-grow">
                                                    <h6 class="preview-subject">Versuche</h6>
                                                </div>
                                                <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                    <p class="text-muted" id="tries">{{$personalscore->count()}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="d-flex flex-row justify-content-between">
                                    <h4 class="card-title mb-1">Tastaturbelegung</h4>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="preview-list">
                                        <div class="preview-item border-bottom">
                                            <div class="preview-item-content d-sm-flex flex-grow">
                                                <div class="flex-grow">
                                                    <h6 class="preview-subject">Pfeiltasten</h6>
                                                </div>
                                                <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                    <p class="text-muted">Block bewegen</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="preview-list">
                                        <div class="preview-item border-bottom">
                                            <div class="preview-item-content d-sm-flex flex-grow">
                                                <div class="flex-grow">
                                                    <h6 class="preview-subject">Enter</h6>
                                                </div>
                                                <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                    <p class="text-muted">Spiel starten</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="preview-list">
                                        <div class="preview-item border-bottom">
                                            <div class="preview-item-content d-sm-flex flex-grow">
                                                <div class="flex-grow">
                                                    <h6 class="preview-subject">C</h6>
                                                </div>
                                                <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                    <p class="text-muted">Block auf Hold setzen</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="preview-list">
                                        <div class="preview-item">
                                            <div class="preview-item-content d-sm-flex flex-grow">
                                                <div class="flex-grow">
                                                    <h6 class="preview-subject">Y</h6>
                                                </div>
                                                <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                    <p class="text-muted">Block <span class="text-info"
                                                                                      data-toggle="tooltip"
                                                                                      data-placement="bottom"
                                                                                      title="counter clockwise, englisch für: „gegen den Uhrzeigersinn“">CCW</span>
                                                        drehen</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="preview-list">
                                        <div class="preview-item">
                                            <div class="preview-item-content d-sm-flex flex-grow">
                                                <div class="flex-grow">
                                                    <h6 class="preview-subject">Leertaste</h6>
                                                </div>
                                                <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                    <p class="text-muted">Block schnell fallen lassen</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card" id="leaderboard">
            @include('intern.leaderboard',['highscore' => $highscore])
        </div>
    </div>
@endsection
