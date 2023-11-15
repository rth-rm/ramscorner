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


        $doneby = Ticket::where('t_ID', $tid)->value('t_assignedTo');
        $doneBy = Reporter::where('u_name',$doneby)->value('u_ID');
        $recipients = Reporter::wherenotIn('u_role', ['Client'])->get();

        if($doneby == null || $doneby == "Not Assigned"){
             foreach ($recipients as $recipient) {
            Notification::create([
                "user_id" => $recipient->u_ID,
                "ticket_id" => $tid,
                "n_message" => 'New message in Ticket#'.$tid

            ]);
        }

        }else{
            Notification::create([
            "user_id"=>$doneBy,
            "ticket_id" => $tid,
            "n_message" => 'New message in Ticket#'.$tid]);
        }



        return redirect()->back();
    }
}
