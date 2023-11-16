<?php

namespace App\Http\Controllers;


use App\Models\k_b_s;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\Models\Reporter;
use App\Models\Notification;

class KB extends Controller
{
    public function admin_KB()
    {

        $admin = Auth::user();
        if ($admin == null) {
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');
        }

        if ($admin->u_role == "Client") {
            Alert::warning('Warning!!!', 'Unauthorized Access!');
            return redirect()->route('clientHome');
        }

        $user_info = Reporter::where('u_ID', $admin->u_ID)->get();
        $kb_info = k_b_s::get();


        $pending = k_b_s::where('kb_status', "PENDING")->get();
        $pending_count = $pending->count();

        $approved = k_b_s::where('kb_status', "APPROVED")->get();
        $approved_count = $approved->count();

        $rejected = k_b_s::where('kb_status', "REJECTED")->get();
        $rejected_count = $rejected->count();

        $notifCount = Notification::where('user_id', $admin->u_ID)->where('read_at', null)->get()->count();
        $notifChatCount = Notification::where('n_message', 'LIKE', '%' . 'New message' . '%')
            ->where('user_id', $admin->u_ID)
            ->where('read_at', null)->get()->count();
        $notify = Notification::where('user_id', $admin->u_ID)->where('read_at', null)->get();
        $notifChat = Notification::where('n_message', 'LIKE', '%' . 'New message' . '%')
            ->where('user_id', $admin->u_ID)
            ->where('read_at', null)->get();

        return view('admin_KB', [
            "notify" => $notify,
            "notifyChat" => $notifChat,
            "notifCount" => $notifCount,
            "notifChatCount" => $notifChatCount,
            'kb_info' => $kb_info,
            'user_loggedin' => $user_info,
            'app_count' => $approved_count,
            'approved' => $approved,
            'pending_count' => $pending_count,
            'pending' => $pending,
            'rejected_count' => $rejected_count,
            'rejected' => $rejected
        ]);
    }


    public function add_kb()
    {
        $user = Auth::user();
        if ($user == null) {
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');
        }



        if ($user->u_role == "Client") {
            Alert::warning('Warning!!!', 'Unauthorized Access!');
            return redirect()->route('clientHome');
        }


        return view('add_kb');
    }

    public function user_KB()
    {
        $client = Auth::user();
        if ($client == null) {
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');
        }


        if ($client->u_role != "Client") {
            Alert::warning('Warning!!!', 'Unauthorized Access!');
            return redirect()->route('adminHome');
        }
        $user_info = Reporter::where('u_ID', $client->u_ID)->get();
        $kb_info = k_b_s::where('kb_status', "APPROVED")
            ->where('kb_view', 1)
            ->get();
        $notifCount = Notification::where('user_id', $client->u_ID)->where('read_at', null)->get()->count();
        $notifChatCount = Notification::where('n_message', 'LIKE', '%' . 'New message' . '%')
            ->where('user_id', $client->u_ID)
            ->where('read_at', null)->get()->count();
        $notify = Notification::where('user_id', $client->u_ID)->where('read_at', null)->get();
        $notifChat = Notification::where('n_message', 'LIKE', '%' . 'New message' . '%')
            ->where('user_id', $client->u_ID)
            ->where('read_at', null)->get();


        return view('user_KB', [
            "notify" => $notify,
            "notifyChat" => $notifChat,
            "notifCount" => $notifCount,
            "notifChatCount" => $notifChatCount, 'kb_info' => $kb_info, 'client' => $user_info
        ]);
    }

    // public function staff_KB()
    // {
    //     $staff = Auth::user();
    //     if ($staff == null) {
    //         Alert::warning('Warning!!!', 'You are not authorized!');
    //         return redirect()->route('loginPage');


    //     }

    //     if ($staff->u_role != "Staff") {
    //         Alert::warning('Warning!!!', 'Unauthorized Access!');
    //         if ($staff->u_role == "Admin") {
    //             return redirect()->route('adminHome');
    //         } else {
    //             return redirect()->route('clientHome');
    //         }
    //     }
    //     $user_info = Reporter::where('u_ID', $staff->u_ID)->get();
    //     $kb_info = k_b_s::where('kb_status', 1)->get();
    //     $notifCount = Notification::where('user_id', $staff->u_ID)->where('read_at', null)->get()->count();
    //     return view('staff_KB', ['notif' => $notifCount, 'kb_info' => $kb_info, 'staff' => $user_info]);
    // }

    public function createKB(Request $request)
    {

        $user = Auth::user();
        if ($user == null) {
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');
        }

        if ($user->u_role == "Client") {
            Alert::warning('Warning!!!', 'Unauthorized Access!');
            return redirect()->route('clientHome');
        }
        $user_info = Reporter::where('u_ID', $user->u_ID)->get();
        // dd($request);

        if ($request->userview) {
            $userview = 1;
        } else {
            $userview = 0;
        }

        if ($request->account_info) {
            $acctinfo = 1;
        } else {
            $acctinfo = 0;
        }


        k_b_s::create([
            'kb_title' => $request->title,
            'kb_content' => $request->content,
            'kb_resolution' => $request->resolution,
            'kb_category' => $request->category,
            'kb_modify' => $user->u_name,
            'kb_view' => $userview


        ]);
        alert('KB Created', 'KB Succesfully added', 'Success')->showConfirmButton('Confirm', '#0d6efd');



        return redirect()->route('admin_KB');
    }

    public function adminkbView($id)
    {

        $kid = intval($id);

        $admin = Auth::user();
        if ($admin == null) {
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');
        }

        if ($admin->u_role == "Client") {
            Alert::warning('Warning!!!', 'Unauthorized Access!');
            return redirect()->route('clientHome');
        }

        $user_info = Reporter::where('u_ID', $admin->u_ID)->get();
        $kb_info = k_b_s::where('kb_ID', $kid)->get()->first();


        if ($kb_info->kb_status == 1) {
            k_b_s::where('kb_ID', $kid)->update([
                'kb_watch' => ($kb_info->kb_watch) + 1
            ]);
        }



        $notifCount = Notification::where('user_id', $admin->u_ID)->where('read_at', null)->get()->count();
        $notifChatCount = Notification::where('n_message', 'LIKE', '%' . 'New message' . '%')
            ->where('user_id', $admin->u_ID)
            ->where('read_at', null)->get()->count();
        $notify = Notification::where('user_id', $admin->u_ID)->where('read_at', null)->get();
        $notifChat = Notification::where('n_message', 'LIKE', '%' . 'New message' . '%')
            ->where('user_id', $admin->u_ID)
            ->where('read_at', null)->get();


        return view(
            'adminkbView',
            [

                "notifCount" => $notifCount,
                "notifChatCount" => $notifChatCount,
                'kb_info' => $kb_info,
                'admin' => $user_info,

                "notify" => $notify,
                "notifyChat" => $notifChat,
            ]
        );
    }

    public function approveKB()
    {



        return redirect()->back();
    }

    // public function staffkbView($id)
    // {

    //     $staff = Auth::user();
    //     if ($staff == null) {
    //         Alert::warning('Warning!!!', 'You are not authorized!');
    //         return redirect()->route('loginPage');


    //     }

    //     if ($staff->u_role != "Staff") {
    //         Alert::warning('Warning!!!', 'Unauthorized Access!');
    //         if ($staff->u_role == "Admin") {
    //             return redirect()->route('adminHome');
    //         } else {
    //             return redirect()->route('clientHome');
    //         }
    //     }
    //     $user_info = Reporter::where('u_ID', $staff->u_ID)->get();
    //     $kb_info = k_b_s::where('kb_ID', $id)->get()->first();
    //     if ($kb_info->kb_status == 1) {
    //         k_b_s::where('kb_ID', $id)->update([
    //             'kb_watch' => ($kb_info->kb_watch) + 1
    //         ]);


    //     }
    //     $notifCount = Notification::where('user_id', $staff->u_ID)->where('read_at', null)->get()->count();
    //     return view('staffkbView', ['notif' => $notifCount, 'kb_info' => $kb_info, 'staff' => $user_info]);
    // }

    public function userkbView($id)
    {
        $client = Auth::user();
        if ($client == null) {
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');
        }

        if ($client->u_role != "Client") {

            return redirect()->route('adminHome');
        }
        $user_info = Reporter::where('u_ID', $client->u_ID)->get();
        $kb_info = k_b_s::where('kb_ID', $id)->get()->first();
        if ($kb_info->kb_status == 1) {
            k_b_s::where('kb_ID', $id)->update([
                'kb_watch' => ($kb_info->kb_watch) + 1
            ]);
        }
        $notifCount = Notification::where('user_id', $client->u_ID)->where('read_at', null)->get()->count();
        $notifChatCount = Notification::where('n_message', 'LIKE', '%' . 'New message' . '%')
            ->where('user_id', $client->u_ID)
            ->where('read_at', null)->get()->count();
        $notify = Notification::where('user_id', $client->u_ID)->where('read_at', null)->get();
        $notifChat = Notification::where('n_message', 'LIKE', '%' . 'New message' . '%')
            ->where('user_id', $client->u_ID)
            ->where('read_at', null)->get();


        return view('userkbView', [

            "notify" => $notify,
            "notifyChat" => $notifChat,
            "notifCount" => $notifCount,
            "notifChatCount" => $notifChatCount, 'kb_info' => $kb_info, 'client' => $user_info
        ]);
    }

    public function updateKB(Request $request)
    {
        $user = Auth::user();
        if ($user == null) {
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');
        }

        if ($user->u_role == "Client") {
            Alert::warning('Warning!!!', 'Unauthorized Access!');
            return redirect()->route('clientHome');
        }
        $user_info = Reporter::where('u_ID', $user->u_ID)->get();

        $approval = k_b_s::where('kb_ID', $request->id)->get()->first();
        if ($approval->kb_status == 0) {
            k_b_s::where('kb_ID', $request->id)->update(
                [
                    'kb_title' => $request->title,
                    'kb_content' => $request->content,
                    'kb_resolution' => $request->resolution,
                    'kb_category' => $request->category,
                    'kb_modify' => $user->u_name,
                    'kb_status' => 1
                ]

            );
        } else {
            k_b_s::where('kb_ID', $request->id)->update(
                [
                    'kb_title' => $request->title,
                    'kb_content' => $request->content,
                    'kb_resolution' => $request->resolution,
                    'kb_category' => $request->category,
                    'kb_modify' => $user->u_name,
                    'kb_status' => 0
                ]

            );
        }


        $message = "Ticket # " . $request->id . " Has been successfully updated";
        Alert::success($message);

        return redirect()->route('admin_KB');
    }
}
