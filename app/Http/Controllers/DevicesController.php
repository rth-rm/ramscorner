<?php

namespace App\Http\Controllers;

use App\Models\Devices;
use App\Http\Controllers\Controller;
use App\Models\RepairHistory;
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

        $device_list = Devices::where('d_show', 1)->get();


        // foreach ($device_list as $dev) {
        //     dd($dev->d_code);

        // }





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
            $last_div_ID = 100001;
        } else {
            $latest_dev_id = Devices::select('d_code')->get()->last();
            $last_dev_digit = (int) substr($latest_dev_id->d_code, -6);
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
            "d_code" => $dev_id,
            "d_name" => strtoupper($request->dname),
            "d_inventorynum" => $request->dinvnum,
            "d_purchase_date" => $request->dpurchased,
            "d_type" => $request->device,
            "d_assignment" => $request->dfloor . '-' . $request->droom,
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


    public function viewDeviceDetail($dcode)
    {

        $device_detail = Devices::where('d_code', $dcode)->get()->first();
        $repair_history = RepairHistory::where('dcode', $dcode)->get();

        return ['device_detail' => $device_detail, 'repair_history' => $repair_history];

    }
    public function editDeviceDetail($dcode)
    {

        $device_detail = Devices::where('d_code', $dcode)->get()->first();
        $repair_history = RepairHistory::where('dcode', $dcode)->get();

        if ($repair_history->count() == 0) {
            $repair_history = "No Repair History Yet";
        }

        return view('edit_device', ['device_detail' => $device_detail, 'repair_history' => $repair_history]);

    }

    public function editDevices(Request $request)
    {
        $user = Auth::user();
        if ($user == null) {
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');
        }
        $user_info = Reporter::where('u_ID', $user->u_ID)->get();


        $last_dev_digit = (int) substr($request->dcode, -6);

        $dev_id = "ITRO-" . $request->device . "-" . $request->dfloor . '-' . $request->droom . "-" . $last_dev_digit;


        Devices::where('d_code', $request->dcode)->update(
            [
                "d_code" => $dev_id,
                "d_name" => strtoupper($request->dname),
                "d_inventorynum" => $request->dinvnum,
                "d_purchase_date" => $request->dpurchased,
                "d_type" => $request->device,
                "d_assignment" => $request->dfloor . '-' . $request->droom,
            ]

        );


        $message = "Device " . $request->dcode . " has been successfully updated";
        Alert::success($message);

        if ($user->u_role == "Admin") {
            return redirect()->route('devices');
        } else {
            return redirect()->route('deices');
        }


    }

    public function archiveDevice($dcode)
    {
        $user = Auth::user();
        if ($user == null) {
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');


        }
        $user_info = Reporter::where('u_ID', $user->u_ID)->get();



        $device = Devices::where('d_code', $dcode)->get()->first();
        if ($device) {
            // Update the device status or perform any other actions
            $device->update(['d_show' => false]);

            // Optionally, you can redirect to another page after archiving
            Alert::success("Archived", "Device {$dcode} has been archived.");
            return back();
        } else {
            // Device not found, handle accordingly (e.g., show an error message)
            return redirect()->back()->with('error', 'Device not found.');
        }


    }



}
