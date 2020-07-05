<?php

namespace App\Http\Controllers;

use App\User;
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

        if ($code == session()->get('code')) {
            //Success
            $user = Auth::user();
            $user->teamspeakuid = session()->get("ts3uid");
            $user->save();

            session()->forget('code');
            session()->forget('ts3uid');
            return redirect()->route('dashboard');
        }
    }
}
