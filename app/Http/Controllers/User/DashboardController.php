<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Donation $donation)
    {
        $user = Auth::user();
        // $getCampaign = $campaign->where('user_id',$user->id)->get()->count();
        // $getCampaignDetail = Campaign::where('user_id',$user->id)->get();
        // $getDonation = 0;
        // $countUser = 0;

        // if ($getCampaignDetail) {            
        //     foreach ($getCampaignDetail as $detail) {
        //         $getDonation = $donation->where('campaign_id',$detail['id'])->get()->count();
        //     }
        // }
        // $collectedDonation = Campaign::select('collected')->where('user_id',$user->id)->pluck('collected')->all();
        // if (!empty($collectedDonation)) {
        //     $totalDonation = array_sum($collectedDonation);
        // } else {
        //     $totalDonation = 0;
        // }

        // $allDonation = $donation->all();

        // foreach ($allDonation as $findDonation) {
        //     if ($findDonation['status']==0 || $findDonation['status']==1) {
        //         if ($findDonation['campaign']['user_id']==$user->id) {
        //             $countUser = User::where('id',$findDonation['user_id'])->get()->count();
        //         }
        //     }
        // }
        $data = [
            'title' => 'Dashboard',
        ];
        return view('user.dashboard.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
