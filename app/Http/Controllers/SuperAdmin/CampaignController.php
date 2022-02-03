<?php

namespace App\Http\Controllers\superAdmin;

use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CampaignController extends Controller
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
    public function index(Campaign $campaign)
    {
        $data = [
            'title'=>'Campaign',
            'campaign'=>$campaign->all()
        ];
        return view('superadmin.campaign.campaign',compact('data'));
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


    public function store()
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
        $getCampaign = Campaign::find($id);
        $data = [
            'title' => $getCampaign->title,
            'description' => $getCampaign->description,
        ];
        return view('superadmin.campaign.show-campaign', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
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
        $campaign = Campaign::where('id',$id)->first();
        
        $update = $campaign->update($validatedData);
        if ($request->status==1) {            
            if ($update == true) {
                return redirect('/superadmin/campaign')->with('success','Confirm publish request is successful');
            }
            else{
                return redirect('/superadmin/campaign')->with('error','Confirm publish request is failed');
            }
        }
        elseif ($request->status==2) {            
            if ($update == true) {
                return redirect('/superadmin/campaign')->with('success','Reject publish request is successful');
            }
            else{
                return redirect('/superadmin/campaign')->with('error','Reject publish request is failed');
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
        $donation = Donation::firstWhere('campaign_id',$id);
        if ($donation) {
            $del = $donation->delete(); 
        }
        $delete = Campaign::destroy($id);
        if ($delete) {
            return redirect('/superadmin/campaign')->with('success','Delete campaign is successful');
        }
        else{
            return redirect('/superadmin/campaign')->with('error','Delete campaign is failed');
        }
    }

    public function getCampaignInfo(Campaign $campaign){
        $id =  $_GET['id'];
        $getData = $campaign->firstWhere('id', $id) ;
        echo json_encode($getData);
    }
}