<?php

namespace App\Http\Controllers;

use App\Models\Devices;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    //DEVICE_LIST
    public function devices()
    {
        $user_loggedin = Auth::user();

        if ($user_loggedin == null) {
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');
        }

        if ($user_loggedin->u_role == "Admin") {
            if ($user_loggedin->u_role != "Admin") {
                Alert::warning('Warning!!!', 'Unauthorized Access!');
                if ($user_loggedin->u_role == "Staff") {
                    return redirect()->route('staffHome');
                } else {
                    return redirect()->route('clientHome');
                }
            }
        } else if ($user_loggedin->u_role == "Staff") {
            if ($user_loggedin->u_role != "Staff") {
                Alert::warning('Warning!!!', 'Unauthorized Access!');
                if ($user_loggedin->u_role == "Admin") {
                    return redirect()->route('adminHome');
                } else {
                    return redirect()->route('clientHome');
                }
            }
        }

        $user_info = Reporter::where('u_ID', $user_loggedin->u_ID)->get();
        $device_list = Devices::get();




        return view('device_list', [
            "user_loggedin" => $user_info,
            "device_list" => $device_list
        ]);

    }

    //ADD DEVICES PAGE
    public function addDevicePage()
    {
        $user_ID = Auth::user();

        if ($user_ID == null) {
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');
        }

        if ($user_ID->u_role == "Admin") {
            if ($user_ID->u_role != "Admin") {
                Alert::warning('Warning!!!', 'Unauthorized Access!');
                if ($user_ID->u_role == "Staff") {
                    return redirect()->route('staffHome');
                } else {
                    return redirect()->route('clientHome');
                }
            }
        } else if ($user_ID->u_role == "Staff") {
            if ($user_ID->u_role != "Staff") {
                Alert::warning('Warning!!!', 'Unauthorized Access!');
                if ($user_ID->u_role == "Admin") {
                    return redirect()->route('adminHome');
                } else {
                    return redirect()->route('clientHome');
                }
            }
        }




        $random = rand(000000000, 999999999);
        // $latest = Devices::get()->count();

        // dd($latest);
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




        $dev_count = Devices::get()->count();

        if ($dev_count == 0) {
            $last_div_ID = 100000;
        } else {
            $latest_dev_id = Devices::get()->last();
            $last_dev_digit = (int) substr($latest_dev_id, -5);
            $last_div_ID = $last_dev_digit + 1;
        }
        $dev_id = "ITRO-" . $request->device . "-" . $request->dfloor . '-' . $request->droom . "-" . $last_div_ID;

        if ($request->file('dev_image')) {
            $file = $request->file('dev_image');
            #filename -> isesave sa database
            $filename = $dev_id . $file->getClientOriginalExtension();
            $file->move(public_path('/deviceImages'), $filename);
        } else {
            $filename = "";
        }



        Devices::create([
            "d_ID" => $dev_id,
            "d_name" => strtoupper($request->dname),
            "d_inventorynum" => $request->dinvnum,
            "d_purchase_date" => $request->dpurchased,
            "d_type" => $request->device,
            "d_assignment" => $request->dfloor . '-' . $request->droom,
            "d_approve" => false,
            "d_submittedby" => $user_ID->u_name
        ]);

        // dd(
        //     $dev_id,
        //     strtoupper($request->dname),
        //     $request->dinvnum,
        //     $request->dpurchased,
        //     $request->device,
        //     $request->dfloor . $request->droom,
        //     false,
        //     $user_ID->u_name
        // );

        Alert::success("Success!", "The added device is successfully sent for review.");
        if ($user_ID->u_role == "Admin") {
            return redirect()->route('devices');
        } elseif ($user_ID->u_role == "Staff") {
            return redirect()->route('devices');
        } else {
            return redirect()->route('clientHome');
        }



    }

}
