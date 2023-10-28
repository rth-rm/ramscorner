<?php

namespace App\Http\Controllers;

use App\Models\Devices;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\StatusHistory;
use App\Models\Ticket;
use App\Models\Reporter;
use RealRashid\SweetAlert\Facades\Alert;
use App\Notifications\TicketUpdatedNotification;
use App\Models\Notification;
use PHPMailer\PHPMailer\PHPMailer;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\NewTicketNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class DevicesController extends Controller
{

    //DEVICES PAGE
    public function addDevicePage()
    {
        $user_ID = Auth::user();

        if ($user_ID == null) {
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');
        }


        $random = rand(000000000, 999999999);
        $latest = Devices::get()->count();

        dd($latest);
        return view('add_device');
    }





    // POST METHOD ADD DEVICES
    public function addDevices(Request $request)
    {


        $user_ID = Auth::user();

        if ($user_ID == null) {
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');
        }


        $random = rand(000000000, 999999999);

        $latest_dev_id = Devices::get()->last();
        dd($latest_dev_id);
        // $dev_id = 

        if ($request->file('dev_image')) {
            $file = $request->file('dev_image');
            #filename -> isesave sa database
            $filename = $random . $file->getClientOriginalExtension();
            $file->move(public_path('/deviceImages'), $filename);
        } else {
            $filename = "";
        }



        Devices::create([
            "d_ID" => $user_ID->u_ID,
            // "t_urgency"=>$request->urgency,
            // "t_impact"=>$request->impact,
            // "t_priority"=>$priority,
            "t_category" => strtoupper($request->category),
            "t_cc" => $request->cc,
            "t_title" => $request->title,
            "t_description" => $request->content,
            "t_image" => $filename
        ]);

        $get_uID = $user_ID->u_ID;
        $get_tID = Ticket::where("u_ID", $get_uID)->get()->last()->t_ID;



        StatusHistory::create([
            "t_ID" => $get_tID

        ]);


        $recipients = Reporter::wherenotIn('u_role', ['Client'])->get();
        foreach ($recipients as $recipient) {
            Notification::create([
                "user_id" => $recipient->u_ID,
                "ticket_id" => $get_tID,
                "n_message" => 'A new ticket is awaiting for your response!'

            ]);
        }

        $allStaff = Reporter::whereNotIn('u_role', ['Client'])->get();


        foreach ($allStaff as $staffs) {
            $mail = new PHPMailer(true); // Passing true enables exceptions
            //email to
            $emailSendTo = Reporter::where('u_ID', $staffs->u_ID)->first();
            // Email server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; //  smtp host
            $mail->SMTPAuth = true;
            $mail->Username = 'rthrmorallos@gmail.com'; //  sender username
            $mail->Password = 'huydgcioffkgmcld'; // sender password
            $mail->SMTPSecure = 'tls'; // encryption - ssl/tls
            $mail->Port = 587; // port - 587/465
            $mail->setFrom($mail->Username, 'RAMs CORNER - ITRO TICKETING SERVICE');


            $mail->addAddress($emailSendTo->email); //from line 275
            $message = '<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>body{h2{color: #111;margin-bottom: 50px;border-left: 5px solid red;padding-left: 10px;line-height: 1em}.inputbox{margin-bottom: 50px}.inputbox input{position:absolute;width: 300px;background:transparent}.inputbox input:focus{color: #495057;background-color: #fff;border-color: #e54b38;outline: 0;box-shadow: none}.inputbox span{position: relative;top: 7px;left: 1px;padding-left: 10px;display: inline-block;transition: 0.5s}.inputbox input:focus ~ span{transform: translateX(-10px) translateY(-32px);font-size: 12px}.inputbox input:valid ~ span{transform: translateX(-10px) translateY(-32px);font-size: 12px}</style>
    </head>
    <body>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous">
    </script>
    <div class="card">
        <img src="https://scontent.fmnl9-2.fna.fbcdn.net/v/t39.30808-6/327170947_916431936156153_7827086269525719389_n.png?stp=dst-jpg&_nc_cat=101&ccb=1-7&_nc_sid=174925&_nc_eui2=AeGt0qx-UDhrzFHDIm3BNSLH1VPS4lRjPArVU9LiVGM8ChUuZNXg-htZJzUqKOSgV0_VzdAuPJQzQGlUHSajBcG-&_nc_ohc=_shXTm7uIf8AX8IMXek&_nc_zt=23&_nc_ht=scontent.fmnl9-2.fna&oh=00_AfDC1RtBmfmwbpwIdl1h3VHSydopXHL-WduU8wV16ukjpQ&oe=64180B80" alt="apc"  class="rounded float-start" style= "width:175px" >
        <h2 class="mb-0">ONLINE TICKET UPDATE</h2>
        <p>Hi <strong>' . $emailSendTo->u_name . '</strong><br>,
<br> This email is to inform you that there is a new ticket awaiting for your response. Please check out the details below.<br><hr>
        <p>Ticket Short Description: ' . $request->title . '</p>

<p>Ticket #: <strong>INC' . $get_tID . ' </strong></p>
        <p>Status:  <strong>NEW</strong></p>
        </p>
<hr>
<p>Thank you.</p><br><br>
<p>Best regards,</p>
<p>RAMS ITRO Ticketing Service System</p>
<br>



<p style="color:rgb(32,31,30); font-family:Calibri,sans-serif; font-size:11pt; text-align:start; background-color:rgb(255,255,255); margin:0px"><b><span lang="en-US" style="font-size:10pt; font-family:&quot;Adobe Garamond Pro&quot;; margin:0px">Information Technology Resource Office</span></b></p>

<p style="margin-top:0px; margin-bottom:0px; margin-top:0px; margin-bottom:0px; color:rgb(32,31,30); font-family:Calibri,sans-serif; font-size:11pt; text-align:start; background-color:rgb(255,255,255); margin:0px"><b><span lang="en-US" style="font-size:10pt; font-family:&quot;Adobe Garamond Pro&quot;; margin:0px">NU - Asia Pacific College</span></b></p>

<p style="margin-top:0px; margin-bottom:0px; margin-top:0px; margin-bottom:0px; color:rgb(32,31,30); font-family:Calibri,sans-serif; font-size:11pt; text-align:start; background-color:rgb(255,255,255); margin:0px"><span lang="en-US" style="font-size:10pt; font-family:&quot;Adobe Garamond Pro&quot;; margin:0px">&nbsp;</span></p>

<p style="margin-top:0px; margin-bottom:0px; margin-top:0px; margin-bottom:0px; color:rgb(32,31,30); font-family:Calibri,sans-serif; font-size:11pt; text-align:start; background-color:rgb(255,255,255); margin:0px"><span lang="en-US" style="font-size:10pt; font-family:&quot;Adobe Garamond Pro&quot;; margin:0px">3 Humabon Place, Magallanes</span></p>

<p style="margin-top:0px; margin-bottom:0px; margin-top:0px; margin-bottom:0px; color:rgb(32,31,30); font-family:Calibri,sans-serif; font-size:11pt; text-align:start; background-color:rgb(255,255,255); margin:0px"><span lang="en-US" style="font-size:10pt; font-family:&quot;Adobe Garamond Pro&quot;; margin:0px">Makati City 1232, Philippines</span></p>

<p style="margin-top:0px; margin-bottom:0px; margin-top:0px; margin-bottom:0px; color:rgb(32,31,30); font-family:Calibri,sans-serif; font-size:11pt; text-align:start; background-color:rgb(255,255,255); margin:0px"><span lang="en-US" style="font-size:10pt; font-family:&quot;Adobe Garamond Pro&quot;; margin:0px">Tel No. (632) 8852-9232 loc. 114</span></p>

<br><br><hr>
<div style="font-size:12px; font-family:"Calibri"; background-color:#e8e8e8; border-top:1px solid gray; padding:10px; color:#5e5e5e; border-bottom-left-radius:5px; border-bottom-right-radius:5px">    <span style="font-size:14px; font-weight:bold">        COMMUNICATION CONFIDENTIALITY NOTICE
</span>    <br aria-hidden="true">    <p style="font-size:10px; line-height:10pt; font-family:"Calibri"; font-style:italic">        This message, its thread, and any attachments are privileged, confidential and intended for the specified recipient only. No part of this message may be shared in any form or manner without the consent of the sender. If you are not the intended recipient of this message, please inform the sender immediately and delete the message from your inbox.
</p></div>
        </div>
    </body>
    </html>';

            $mail->isHTML(true); // Set email content format to HTML
            $mail->Subject = "New Ticket";
            $mail->Body = $message;
            // $mail->AltBody = plain text version of email body;
            if (!$mail->send()) {
                return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
            }
        }



        Alert::success("Success!", "Your ticket was sent successfully. Please wait for the notification of status updates of your ticket.");
        if ($user_ID->u_role == "Admin") {
            return redirect()->route('adminHome');
        } elseif ($user_ID->u_role == "Staff") {
            return redirect()->route('staffHome');
        } else {
            return redirect()->route('clientHome');
        }

    }

}
