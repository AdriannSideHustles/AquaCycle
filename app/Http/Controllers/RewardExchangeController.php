<?php

namespace App\Http\Controllers;

use App\Models\reward;
use App\Models\RewardExchange;
use App\Models\UserStats;
use Illuminate\Http\Request;

class RewardExchangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rewardExchanges = RewardExchange::with('reward')->where('user_id', auth()->id())->whereIn('status', ["Pending","Approved"])->orderBy('created_at', 'desc')->get();
        $rewards = reward::orderBy('description', 'asc')->get();
        $userStats = UserStats::with('user')->where('user_id', auth()->id())->first();
        return view('student.RewardExchange.index', compact('rewardExchanges','rewards','userStats'));
    }
    public function SuccessfulRedeems(){
        $rewardExchanges = RewardExchange::with('reward')->where('user_id', auth()->id())->where('status', 'Redeemed')->orderBy('created_at', 'desc')->get();
        return view('student.RewardExchange.SuccessfulRedeems', compact('rewardExchanges'));
    }
    public function RejectedRequests(){
        $rewardExchanges = RewardExchange::with('reward')->where('user_id', auth()->id())->where('status', 'Rejected')->orderBy('created_at', 'desc')->get();
        return view('student.RewardExchange.RejectedRequests', compact('rewardExchanges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rewards = reward::orderBy('description', 'asc')->paginate(8);
        $userStats = UserStats::with('user')->where('user_id', auth()->id())->first();
        return view('student.RewardExchange.create',compact('rewards','userStats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        RewardExchange::create([
            'user_id' => auth()->id(),
            'reward_id'=> $request->input('reward_id'),
            'qty'=> $request->input('qty'),
            'status'=> "Pending",
        ]);
        return redirect()->route('reward_exchange.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RewardExchange  $rewardExchange
     * @return \Illuminate\Http\Response
     */
    public function show(RewardExchange $rewardExchange)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RewardExchange  $rewardExchange
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rewardExchange = RewardExchange::with('reward')->find($id);
        return response()->json($rewardExchange);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RewardExchange  $rewardExchange
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rewardExchange = RewardExchange::find($id);
        $rewardExchange->update([
            'qty' => $request->qty,
        ]);

        return response()->json(['success' => 'Reward Exchange updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RewardExchange  $rewardExchange
     * @return \Illuminate\Http\Response
     */
    public function destroy(RewardExchange $rewardExchange)
    {
        //
    }
}
