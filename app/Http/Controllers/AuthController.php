<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Reporter;
use Illuminate\Support\Facades\DB;
use App\Models\Ticket;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function loginPage()
    {
        $user_id = Auth::user();
        if ($user_id == null) {
            return view('login');
        }


        $user_info = DB::table('reporters')->where("u_id", $user_id->u_ID)->first();

        if ($user_info->u_role == 'Admin' || $user_info->u_role == 'Staff') {
            return redirect()->route('adminHome');
        }else {
            return redirect()->route('clientHome');
        }
    }

    public function signout(Request $request)
    {


        $redirect = Auth::user()->u_role;
        auth()->guest();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('loginPage');
    }

    public function loginUser(Request $request)
    {
        try {
            // dd($request);
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {

                response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
                Alert::error('Oops!', 'Wrong email or Password');
                return redirect()->route('loginPage');

            }

            $thirtyMinutesAgo = Carbon::now()->subMinutes(30);
            $user = Reporter::where('email', $request->email)->first();
            if ($user->u_role == 'Admin') {
                response()->json([
                    'status' => true,
                    'message' => 'User Logged In Successfully',
                    'token' => $user->createToken("API TOKEN")->plainTextToken
                ], 200);
                $newpastthirtymins = Ticket::where('t_status', "NEW")
                        ->where('t_datetime', '>', $thirtyMinutesAgo)
                        ->get()->count();
                Alert::toast('Login Succcess!', 'success');
                Alert::toast($newpastthirtymins. 'tickets are still unopened. Check them out!');

                return redirect()->route('adminHome');


            } else if ($user->u_role == 'Staff') {
                response()->json([
                    'status' => true,
                    'message' => 'User Logged In Successfully',
                    'token' => $user->createToken("API TOKEN")->plainTextToken
                ], 200);
                Alert::toast('Login Success!', 'success');
                return redirect()->route('adminHome');

            } else {
                response()->json([
                    'status' => true,
                    'message' => 'User Logged In Successfully',
                    'token' => $user->createToken("API TOKEN")->plainTextToken
                ], 200);
                Alert::toast('Login Succcess!', 'success');
                return redirect()->route('clientHome');

            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
