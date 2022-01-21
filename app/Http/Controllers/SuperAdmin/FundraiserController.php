<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\User;
use App\Models\Payment;
use App\Models\Profile;
use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PaymentController;
use App\Models\Company;

class FundraiserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Company $company)
    {
        $users = User::where('role',1)->get();
        $data = [
            'title' => 'Fundraiser',
        ];
        return view('superadmin.user-data.fundraiser',compact('data','users','company')); 
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
        $user = User::where('id',$id)->first();
        $getProfile = Profile::where('user_id',$id)->first();
        $getCampaign = Campaign::where('user_id',$id)->get();
        $getContributor = 0;
        $getDonation = Donation::where('status',1)->get();
        if ($getCampaign) {
            foreach ($getCampaign as $campaignData) {
                foreach ($campaignData->donation as $donation) {
                    if ($donation['status']==1) {
                        $getContributor++;
                    }
                }
            }
        }

        $collectedDonation = Campaign::select('collected')->where('user_id',$id)->pluck('collected')->all();
        if (!empty($collectedDonation)) {
            $amountDonation = array_sum($collectedDonation);
        } else {
            $amountDonation = 0;
        }

        $data = [
            'title' => 'Profile of '. $user->name,
            'countCampaign' => $getCampaign ? $getCampaign->count() : 0,
            'countContributor' => $getContributor,
            'amountDonation' => $amountDonation,
            'user_id' => $id,
        ];
        return view('superadmin.user-data.show-fundraiser',compact('data','getProfile','getCampaign')); 
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
        $paymentController = new PaymentController;
        $donation = Donation::firstWhere('user_id',$id);
        $payment = Payment::firstWhere('donation_id',$donation->id);
        $user = User::firstWhere('id',$id);
        if ($payment) {
            $delPayment = $paymentController->destroy($payment->id);
        }
        if ($donation) {
            $delDonation = $donation->delete(); 
        }
        $delete = User::destroy($id);
        if ($delete) {
            return redirect('/superadmin/contributor')->with('success','Delete contributor is successful');
        }
        else{
            return redirect('/superadmin/contributor')->with('error','Delete contributor is failed');
        }
    }
}
