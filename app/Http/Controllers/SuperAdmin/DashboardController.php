<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\User;
use App\Models\Payment;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Campaign $campaign, Donation $donation, User $user)
    {
        $user = Auth::user();
        $getCampaign = $campaign->all()->count();
        $getDonation = $donation->where('status',1)->count();
        $getContributor = Donation::select('user_id')->distinct()->count('user_id');

        $collectedDonation = Campaign::select('collected')->pluck('collected')->all();
        if (!empty($collectedDonation)) {
            $totalDonation = array_sum($collectedDonation);
        } else {
            $totalDonation = 0;
        }

        $allDonation = $donation->all();

        $getPayment = Payment::where('status',1)->get();
        $getWithdraw = Withdraw::where('status',0)->get();
        $getCampaignStatus = Campaign::where('status',0)->get();
        $data = [
            'title' => 'Dashboard',
        ];
        return view('superadmin.dashboard.index',compact(
            'data',
            'getCampaign',
            'getDonation',
            'getContributor',
            'totalDonation',
            'getPayment',
            'getCampaignStatus',
            'getWithdraw',
            'user',
        ));
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
