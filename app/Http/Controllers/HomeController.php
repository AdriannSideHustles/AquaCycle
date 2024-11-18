<?php

namespace App\Http\Controllers;

use App\Models\BottleDisposal;
use App\Models\RewardExchange;
use App\Models\User;
use App\Models\UserStats;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function admin(){
        $rewardExchanges = RewardExchange::with('user')->orderBy('created_at', 'desc')->get();
        $successfulExchanges = $rewardExchanges->where('status','Successful')->count();
        $rejectedExchanges = $rewardExchanges->where('status','Rejected')->count();
        $usersCount = User::count();
        $totalCollectedBottles = BottleDisposal::sum('bottles_qty');

        

        $dailyPoint = BottleDisposal:: selectRaw('DATE(disposal_date) as date, SUM(points_received) as total_point')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $dailyLabels = $dailyPoint->pluck('date')->map(function ($date) {
            return date('M d', strtotime($date));
        });

        $dailyPoints = $dailyPoint->pluck('total_point');

        $monthlyBottleDisposal = BottleDisposal::selectRaw('MONTH(disposal_date) as month, YEAR(disposal_date) as year, SUM(bottles_qty) as total_bottleDisposal')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $monthlyLabels = $monthlyBottleDisposal->map(function ($disposal) {
            return date('F', mktime(0, 0, 0, $disposal->month, 1)); // Convert month number to month name
        });

        $monthlyBottleDisposals = $monthlyBottleDisposal->pluck('total_bottleDisposal');


        return view("admin.dashboard", compact(
            'rewardExchanges',
            'successfulExchanges',
            'rejectedExchanges',
            'usersCount',
            'totalCollectedBottles',
            'dailyPoint',
            'dailyPoints',
            'dailyLabels',
            'monthlyBottleDisposal',
            'monthlyBottleDisposals',
            'monthlyLabels'
        ));
    }
    public function student(){
        $userStats = UserStats::with('user')->where('user_id', auth()->id())->first();
        $rewardExchanges = RewardExchange::with('user')->where('user_id',auth()->id())->orderBy('created_at', 'desc')->get();

        $successfulExchanges = $rewardExchanges->where('status','Successful')->count();
        $rejectedExchanges = $rewardExchanges->where('status','Rejected')->count();

        $dailyPoint = BottleDisposal:: selectRaw('DATE(disposal_date) as date, SUM(points_received) as total_point')
            ->where('user_id', auth()->id())
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $monthlyBottleDisposal = BottleDisposal::selectRaw('MONTH(disposal_date) as month, YEAR(disposal_date) as year, SUM(bottles_qty) as total_bottleDisposal')
            ->where('user_id', auth()->id())
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $dailyLabels = $dailyPoint->pluck('date')->map(function ($date) {
            return date('M d', strtotime($date));
        });

        $dailyPoints = $dailyPoint->pluck('total_point');

        $monthlyLabels = $monthlyBottleDisposal->map(function ($disposal) {
            return date('F', mktime(0, 0, 0, $disposal->month, 1)); // Convert month number to month name
        });

        $monthlyBottleDisposals = $monthlyBottleDisposal->pluck('total_bottleDisposal');

        return view("student.dashboard", compact(
            'rewardExchanges',
            'userStats',
            'successfulExchanges',
            'rejectedExchanges',
            'dailyPoint',
            'dailyPoints',
            'dailyLabels',
            'monthlyBottleDisposal',
            'monthlyBottleDisposals',
            'monthlyLabels'));
    }
}
