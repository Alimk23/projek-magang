<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\User;
use App\Models\Payment;
use App\Models\Profile;
use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PaymentController;
use App\Models\Company;
use App\Models\RegistrationStatus;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Company $company)
    {
        $users = User::where('role',1)->with('RegistrationStatus')->get();
        $data = [
            'title' => 'Organization',
        ];
        return view('superadmin.user-data.organization',compact('data','users','company')); 
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
        return view('superadmin.user-data.show-organization',compact('data','getProfile','getCampaign')); 
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
        $validatedData = $request->validate([
            'status' => 'required|max:255',
        ]);
        $registrationStatus = RegistrationStatus::where('user_id',$id)->first();
        
        $update = $registrationStatus->update($validatedData);
        if ($request->status==1) {            
            if ($update == true) {
                return redirect('/superadmin/organization')->with('success','Confirm organization request is successful');
            }
            else{
                return redirect('/superadmin/organization')->with('error','Confirm organization request is failed');
            }
        }
        elseif ($request->status==2) {            
            if ($update == true) {
                return redirect('/superadmin/organization')->with('success','Reject organization request is successful');
            }
            else{
                return redirect('/superadmin/organization')->with('error','Reject organization request is failed');
            }
        }
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
