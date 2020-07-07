<?php

namespace App\Http\Controllers;

use Adams\TeamSpeak3\Adapter\ServerQuery\Exception;
use App\User;
use App\Game;
use App\Highscore;
use Illuminate\Http\Request;
use Adams\TeamSpeak3\Facades\TeamSpeak3;
use Illuminate\Support\Facades\Auth;

class TeamSpeakController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ChooseManual()
    {
        return view('teamspeak3.clientlist', [
            'clients' => TeamSpeak3::clientList(["client_type" => 0])
        ]);
    }

    public function FindAccount()
    {
        $clientIP = TeamSpeak3::clientList(["connection_client_ip" => \Request::ip(), "client_type" => 0]);

        if (!empty($clientIP) && COUNT($clientIP) == 1) {
            return view('teamspeak3.clientfound', [
                'clients' => $clientIP
            ]);
        } else {
            return $this->ChooseManual();
        }
    }

    public function ClientSubmit(Request $request)
    {
        $clid = $request->input('client');
        $client = TeamSpeak3::clientGetById($clid);
        $alphabet = 'abcdef234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 6; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $code = implode($pass);

        session()->put('ts3code', $code);
        session()->put('ts3uid', $client->client_unique_identifier);

        $message = <<<EOT
Hey $client->client_nickname,
Es wurde gerade versucht, deine Identität an ein GameRangerZ-Konto zu verknüpfen.
[U]Wenn du das warst:[/U]
 - Kopiere diesen Code: [COLOR=#ff0000]$code [/COLOR]
[U]Wenn du das nicht warst[/U]
 - Ignoriere diese Nachricht
EOT;
        $client->message($message);

        return view('teamspeak3.submitcode');
    }

    public function VerifyCode(Request $request)
    {
        $code = $request->input('code');
        if ($code == session()->get('ts3code')) {
            //Success
            $user = Auth::user();
            $user->teamspeakuid = session()->get("ts3uid");
            $user->save();
            //Registriert = 7
            $client = TeamSpeak3::clientGetByUid($user->teamspeakuid);
            try {
                TeamSpeak3::serverGroupClientAdd(7, $client->client_database_id);
            } catch (Exception $e) {

            }
            session()->forget('ts3code');
            session()->forget('ts3uid');
            return redirect()->route('dashboard');
        } else {
            session()->forget('ts3code');
            session()->forget('ts3uid');
            return redirect()->route('dashboard')->with('error', 'Der Code stimmt nicht überein.');
        }
    }

    public function tetris()
    {
        $user = Auth::user();
        $game = Game::firstOrCreate(['name' => 'Tetris']);
        $highscore = Highscore::selectRaw('*,MAX(score) as score')->orderBy('score', 'desc')->groupBy('user_id')->get();

        $personalscore = Highscore::where('user_id', $user->id)->orderBy('score', 'desc')->get();

        return view('intern.tetris', ['user' => $user, 'game' => $game, 'highscore' => $highscore, 'personalscore' => $personalscore]);
    }

    public function tetrisSubmit(Request $request)
    {
        $user = Auth::user();
        $game = Game::firstOrCreate(['name' => 'Tetris']);

        $score = $request->input('score');
        Highscore::create(['score' => $score, 'user_id' => $user->id, 'game_id' => $game->id]);


        $highscore = Highscore::selectRaw('*,MAX(score) as score')->orderBy('score', 'desc')->groupBy('user_id')->get();
        return view('intern.leaderboard', ['user' => $user, 'highscore' => $highscore]);
    }
}
