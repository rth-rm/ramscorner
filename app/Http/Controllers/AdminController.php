<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Requests;
use App\Models\StatusHistory;
use App\Models\Reporter;
use App\Models\Ticket;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\View\View\share;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;
use App\Models\TicketMessages;
use App\Http\Controllers\TicketController;
use App\Models\RepairHistory;

class AdminController extends Controller
{


    protected $device;

    public function __construct(DevicesController $device)
    {
        $this->device = $device;
    }
    public function adminHome()
    {

        $admin = Auth::user();
        if ($admin == null) {
            Alert::warning('Warning!!!', 'You are not authorized!');
            return redirect()->route('loginPage');
        }


        $thirtyMinutesAgo = Carbon::now()->subMinutes(30);
        $newpastthirtymins = Ticket::where('t_status', "NEW")
            ->where('t_datetime', '>', $thirtyMinutesAgo)
            ->get()->count();
        if ($newpastthirtymins != 0) {
            Alert::toast($newpastthirtymins . ' tickets are still unopened. Check them out!');
        }

        if ($admin->u_role == "Client") {
            Alert::warning('Warning!!!', 'Unauthorized Access!');
            return redirect()->route('clientHome');
        }
        // dd($client);
        //'client_home' -> blade
        //["client"=>$client] -> variable na ipapasa from controller to view
        $user_info = Reporter::where('u_ID', $admin->u_ID)->get();

        $allUser = Reporter::get()->pluck('u_name');
        $userCount = Reporter::all()->count();
        $staffCount = Reporter::whereNotIn('u_role', ['Client'])->get()->count();

        //add to staff

        $mostViewTicket = DB::table('tickets')->orderBy('t_views', 'desc')->get();
        $mostViewKBS = DB::table('k_b_s')->orderBy('kb_watch', 'desc')->where('kb_status', "APPROVED")->get();



        $mostViewTixs = $mostViewTicket->first();
        $mostViewKbs = $mostViewKBS->count();

        if ($mostViewTixs != null) {
            if ($mostViewTixs->t_views == 0) {
                $mostViewTix = "--";
                $views = 0;
            } else {
                $mostViewTixss = DB::table('tickets')
                    ->orderBy('t_views', 'desc')
                    ->get()
                    ->first();
                $mostViewTix = $mostViewTixss->t_ID;
                $views = $mostViewTixss->t_views;
            }
        } else {
            $mostViewTix = 0;
            $views = 0;
        }


        $ticketIds = Ticket::get()->all();

        $escalatedTickets = StatusHistory::whereIn('t_ID', $ticketIds)
            ->where('sh_status', 'ESCALATED')
            ->get()
            ->groupBy('t_ID')->count();
        $escalated = $escalatedTickets;
        if (
            $mostViewKbs == 0 || $mostViewKB = DB::table('k_b_s')->orderBy('kb_watch', 'desc')
                ->where('kb_status', "APPROVED")->get()->first()->kb_watch == 0
        ) {
            $mostViewKB = "--";
            $watch = 0;
        } else {
            $mostViewKBss = DB::table('k_b_s')->orderBy('kb_watch', 'desc')
                ->where('kb_status', "APPROVED")->get()->first();
            $mostViewKB = $mostViewKBss->kb_ID;
            $watch = $mostViewKBss->kb_watch;
        }
        //

        $all = Ticket::all()->count();
        $new = Ticket::where('t_status', 'NEW')->get()->count();
        $opened = Ticket::where('t_status', 'OPENED')->get()->count();
        $pending = Ticket::where('t_status', 'PENDING')->get()->count();
        $ongoing = Ticket::where('t_status', 'ONGOING')->get()->count();
        $resolved = Ticket::where('t_status', 'RESOLVED')->get()->count();
        $closed = Ticket::where('t_status', 'CLOSED')->get()->count();
        $reopened = Ticket::where('t_status', 'REOPENED')->get()->count();
        $rejected = Ticket::where('t_status', 'REJECTED')->get()->count();
        $cancelled = Ticket::where('t_status', 'CANCELLED')->get()->count();



        $data = DB::table('tickets')->select('t_status', DB::raw('count(*) as total'))->groupBy('t_status')->get();
        $assigned = DB::table('tickets')->select('t_assignedTo', DB::raw('count(*) as total'))->groupBy('t_assignedTo')->get();
        $priority = DB::table('tickets')->select('t_priority', DB::raw('count(*) as total'))->groupBy('t_priority')->get();

        //daily
        $tickets = DB::table('tickets')
            ->select(DB::raw('DATE(t_datetime) as date'), DB::raw('COUNT(*) as number'))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->toArray();
        //weekly
        $tickets_weekly = DB::table('tickets')
            ->select(DB::raw('WEEK(t_datetime) as week'), DB::raw('COUNT(*) as number'))
            ->groupBy('week')
            ->orderBy('week')
            ->get();


        //monthly
        $tickets_monthly = DB::table('tickets')
            ->select(DB::raw('DATE_FORMAT(t_datetime, "%M") as month'), DB::raw('COUNT(*) as total'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        //yearly
        $tickets_yearly = DB::table('tickets')
            ->select(DB::raw('YEAR(t_datetime) as year'), DB::raw('COUNT(*) as total'))
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        $bri = DB::table('tickets')
            ->where('t_due', '<', Carbon::now())
            ->where('t_status', '<>', 'resolved')
            ->where('t_status', '<>', 'rejected')
            ->where('t_status', '<>', 'closed')
            ->where('t_status', '<>', 'cancelled')
            ->get();

        if ($bri->count() == 0) {
            // dd('No Breach');
        } else {
            foreach ($bri as $breach) {
                // dd(' Breach');
            }
        }




        $totalCount = Ticket::where('t_assignedTo', $admin->u_name)->get()->count();
        $statusCounts = [
            'NEW' => 0,
            'OPENED' => 0,
            'PENDING' => 0,
            'ONGOING' => 0,
            'RESOLVED' => 0,
            'CLOSED' => 0,
            'CANCELLED' => 0,
            'REJECTED' => 0,
            'REOPENED' => 0,
            'ESCALATED' => 0
        ];

        $ticketss = Ticket::where('t_assignedTo', $admin->u_name)->select('t_status')->get();
        foreach ($ticketss as $ticketsss) {
            $statusCounts[$ticketsss->t_status]++;
        }

        $ticketData = [
            'user' => $admin->u_name,
            'statusCounts' => $statusCounts,
            'totalCount' => $totalCount,
        ];

        $ticketssss = Ticket::select('t_status', 't_due')
            ->get()
            ->map(function ($ticketsssss) {
                $dueDate = Carbon::parse($ticketsssss->t_due);
                $now = Carbon::now();
                $isOverdue = $dueDate->isPast();
                $ticketsssss->breaches = $isOverdue ? ($now->diffInMinutes($dueDate) > 0 ? true : false) : false;
                return $ticketsssss;
            });

        $ticketsssss = $ticketssss->where('breaches', true)->count();

        list($statusCounts, $softwareCounts, $hardwareCounts) = $this->dashboard();

        $notifCount = Notification::where('user_id', $admin->u_ID)->where('read_at', null)->get()->count();
        $notifChatCount = Notification::where('n_message', 'LIKE', '%' . 'New message' . '%')
            ->where('user_id', $admin->u_ID)
            ->where('read_at', null)->get()->count();
        $notify = Notification::where('user_id', $admin->u_ID)->where('read_at', null)->get();
        $notifChat = Notification::where('n_message', 'LIKE', '%' . 'New message' . '%')
            ->where('user_id', $admin->u_ID)
            ->where('read_at', null)->get();


        return view('admin_home', [
            "notify" => $notify,
            "notifyChat" => $notifChat,
            "notifCount" => $notifCount,
            "notifChatCount" => $notifChatCount,
            "statusmonth" => $statusCounts,
            "softwaremonth" => $softwareCounts,
            "hardwaremonth" => $hardwareCounts,
            "notif" => $notifCount,
            "admin" => $user_info,
            'all' => $all,
            'new' => $new,
            'opened' => $opened,
            'pending' => $pending,
            'ongoing' => $ongoing,
            'resolved' => $resolved,
            'closed' => $closed,
            'reopened' => $reopened,
            'rejected' => $rejected,
            'cancelled' => $cancelled,
            'data' => $data,
            'assign' => $assigned,
            'priority' => $priority,
            'tickets' => $tickets,
            'weekly' => $tickets_weekly,
            'monthly' => $tickets_monthly,
            'yearly' => $tickets_yearly,
            'allUser' => $allUser,
            'userCount' => $userCount,
            'staffCount' => $staffCount,
            'mostViewTix' => $mostViewTix,
            'views' => $views,
            'mostViewKB' => $mostViewKB,
            'watch' => $watch,
            'ticketData' => $ticketData,
            'escalated' => $escalated,
            'overdue' => $ticketsssss

        ], );
    }


    public function dashboard()
    {

        $tickets = Ticket::all();

        // Initialize an array to store the aggregated status counts per month
        $statusCountsPerMonth = [];
        $softwareCountsPerMonth = [];
        $hardwareCountsPerMonth = [];

        foreach ($tickets as $ticket) {
            $month = date('Y-m', strtotime($ticket->t_datetime)); // Adjust based on your actual timestamp column

            // Initialize the status counts array for the month if it doesn't exist
            if (!isset($statusCountsPerMonth[$month])) {
                $statusCountsPerMonth[$month] = [
                    'opened' => 0,
                    'ongoing' => 0,
                    'pending' => 0,
                    'resolved' => 0,
                    'closed' => 0,
                    // Add other status types as needed
                ];
            }

            // Retrieve the status history for the ticket
            $statusHistory = StatusHistory::where('t_ID', $ticket->t_ID)->pluck('sh_Status')->toArray();

            // Loop through the status history and update the counts
            foreach ($statusHistory as $status) {
                switch ($status) {
                    case 'OPENED':
                        $statusCountsPerMonth[$month]['opened']++;
                        break;
                    case 'ONGOING':
                        $statusCountsPerMonth[$month]['ongoing']++;
                        break;
                    case 'PENDING':
                        $statusCountsPerMonth[$month]['pending']++;
                        break;
                    case 'RESOLVED':
                        $statusCountsPerMonth[$month]['resolved']++;
                        break;
                    case 'CLOSED':
                        $statusCountsPerMonth[$month]['closed']++;
                        break;
                }
            }

            if ($ticket->t_category === 'SOFTWARE') {
                $softwareCountsPerMonth[$month] = ($softwareCountsPerMonth[$month] ?? 0) + 1;
            } elseif ($ticket->t_category === 'INFRASTRUCTURE') {
                $hardwareCountsPerMonth[$month] = ($hardwareCountsPerMonth[$month] ?? 0) + 1;
            }
        }

        // Use a single variable to pass data to the view
        $statusCounts = collect($statusCountsPerMonth);
        $softwareCounts = collect($softwareCountsPerMonth);
        $hardwareCounts = collect($hardwareCountsPerMonth);


        return ([$statusCounts, $softwareCounts, $hardwareCounts]);
    }














    public function viewAllTickets()
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
        $alltickets = Ticket::select('t_ID', 't_category', 't_assignedTo', 't_title', 't_status', 't_priority', 't_datetime', 't_due', DB::raw('(CASE WHEN t_due < NOW() THEN 1 ELSE 0 END) AS breaches'))
            ->get()->sortByDesc('t_datetime');
        $allUsers = Reporter::all();
        $allStaff = Reporter::whereNotIn('u_role', ['Client'])->get();


        $currentDateTime = now();

        $ticketssss = Ticket::select('t_status', 't_due')
            ->get()
            ->map(function ($ticketsssss) {
                $dueDate = Carbon::parse($ticketsssss->t_due);
                $now = Carbon::now();
                $isOverdue = $dueDate->isPast();
                $ticketsssss->breaches = $isOverdue ? ($now->diffInMinutes($dueDate) > 0 ? true : false) : false;
                return $ticketsssss;
            });

        $ticketsssss = $ticketssss->where('breaches', true)->count();

        $notifCount = Notification::where('user_id', $admin->u_ID)->where('read_at', null)->get()->count();
        $notifChatCount = Notification::where('n_message', 'LIKE', '%' . 'New message' . '%')
            ->where('user_id', $admin->u_ID)
            ->where('read_at', null)->get()->count();
        $notify = Notification::where('user_id', $admin->u_ID)->where('read_at', null)->get();
        $notifChat = Notification::where('n_message', 'LIKE', '%' . 'New message' . '%')
            ->where('user_id', $admin->u_ID)
            ->where('read_at', null)->get();





        $notifCount = Notification::where('user_id', $admin->u_ID)->where('read_at', null)->get()->count();
        return view('view_all_tickets', [

            "notify" => $notify,
            "notifyChat" => $notifChat,
            "notifCount" => $notifCount,
            "notifChatCount" => $notifChatCount,
            "notif" => $notifCount,
            "tickets" => $alltickets,
            "users" => $allUsers,
            "user_loggedin" => $user_info,
            'allStaff' => $allStaff,
            'curDatetime' => $currentDateTime,
            'ticketsss' => $ticketssss
        ]);
    }

    public function openTicket($t_id)
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
        $tickets = Ticket::where('t_id', $t_id)->get()->first();
        $client = Reporter::where('u_ID', $tickets->u_ID)->get()->first();

        $status = StatusHistory::where('t_id', $tickets->t_ID)->get();
        $staff = Reporter::whereNotIn('u_role', ['Client'])->get();

        $device_detail = [];
        $repair_history = [];

        if ($tickets->t_category == "INFRASTRUCTURE") {
            $dev = $this->device->viewDeviceDetail($tickets->dev_code);
            $device_detail = $dev['device_detail'];
            $repair_history = $dev['repair_history'];
        }


        $tickets->t_views = ($tickets->t_views) + 1;
        $tickets->t_status = "OPENED";
        $tickets->save();

        StatusHistory::create([
            "t_ID" => $tickets->t_ID,
            "sh_Status" => 'OPENED',
            "sh_AssignedTo" => $tickets->t_assignedTo,
            "sh_doneBy" => $admin->u_name

        ]);

        $notify = Notification::where('user_id', $admin->u_ID)->where('read_at', null)->get();
        $notifChat = Notification::where('n_message', 'LIKE', '%' . 'New message' . '%')
            ->where('user_id', $admin->u_ID)
            ->where('read_at', null)->get();


        $chats = TicketMessages::where('tix_id', $tickets->t_ID)->get();
        $chatss = TicketMessages::where('tix_id', $tickets->t_ID)->get()->count();


        $last = StatusHistory::where('t_id', $tickets->t_ID)->get()->last();

        $notifCount = Notification::where('user_id', $admin->u_ID)->where('read_at', null)->get()->count();
        $notifChatCount = Notification::where('n_message', 'LIKE', '%' . 'New message' . '%')
            ->where('user_id', $admin->u_ID)
            ->where('read_at', null)->get()->count();


        return view(
            'admin_open_ticket',
            [

                "notify" => $notify,
                "notifyChat" => $notifChat,
                "notifCount" => $notifCount,
                "notifChatCount" => $notifChatCount,
                'device' => $device_detail,
                'repair' => $repair_history,
                'ticket_id' => $t_id,
                'chats' => $chats,
                'chatss' => $chatss,
                'last' => $last,
                'tickets' => $tickets,
                "admin" => $user_info,
                'client' => $client,
                'status' => $status,
                'staffs' => $staff
            ]
        );
    }
}
