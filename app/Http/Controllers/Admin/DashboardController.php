<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Campaign $campaign, Donation $donation)
    {
        $user = Auth::user();
        $getCampaign = $campaign->where('user_id',$user->id)->get()->count();
        $getCampaignDetail = Campaign::where('user_id',$user->id)->get();
        $getDonation = 0;

        if ($getCampaignDetail) {            
            foreach ($getCampaignDetail as $detail) {
                $getDonation = $donation->where('campaign_id',$detail['id'])->get()->count();
            }
        }
        $collectedDonation = Campaign::select('collected')->where('user_id',$user->id)->pluck('collected')->all();
        if (!empty($collectedDonation)) {
            $totalDonation = array_sum($collectedDonation);
        } else {
            $totalDonation = 0;
        }

        $allDonation = $donation->all();

        $countUser = Donation::select('user_id')->distinct()->count('user_id');

        $data = [
            'title' => 'Dashboard',
        ];
        return view('admin.dashboard.index',compact('data','getCampaign','getDonation','countUser','totalDonation'));
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
