<?php

namespace App\Http\Controllers;
use App\Models\TicketMessages;
use App\Models\Ticket;
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

        if($user_ID == null){
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');
        }


        // $request->validate([
        //     'message' => 'required|string',
        // ]);


        $uid = $user_ID->u_ID;

        // dd(auth()->id());
        $message = new TicketMessages([
            'us_id' => auth()->id(), // Assuming you have user authentication
            'm_content' => $request->input('message'),
            'tix_id' =>$tid
        ]);
        $message->save();


        // Broadcast the message for real-time chat (if using WebSocket or Laravel Echo)

        return redirect()->back();
    }
}
