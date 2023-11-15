<?php

namespace App\Http\Controllers;

use App\Models\TicketMessages;
use App\Models\Ticket;
use App\Models\Notification;
use App\Models\Reporter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Reporter as Authenticatable;
use RealRashid\SweetAlert\Facades\Alert;


class ChatsController extends Controller
{
    public function sendmessages(Request $request, $tid)
    {

        $user_ID = Auth::user();

        if ($user_ID == null) {
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');
        }


        $request->validate([
            'message' => 'required|string',
        ]);


        $uid = $user_ID->u_ID;

        // dd($request->message);

        $message = new TicketMessages([
            'us_id' => auth()->id(),
            'm_content' => $request->message,
            'tix_id' => $tid
        ]);
        $message->save();

        Notification::create([
            "user_id"=>$uid,
            "ticket_id" => $tid,
            "n_message" => 'New message in Ticket#'.$tid

        ]);

        return redirect()->back();
    }
}
