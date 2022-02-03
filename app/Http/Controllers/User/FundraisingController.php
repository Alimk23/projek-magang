<?php

namespace App\Http\Controllers\User;

use App\Models\Campaign;
use App\Models\Fundraising;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DonationByFundraiser;
use Illuminate\Support\Facades\Auth;

class FundraisingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Campaign $campaign, DonationByFundraiser $donationByFundraiser)
    {
        $auth = Auth::user();
        $getFundraising = Fundraising::where('user_id', $auth->id)->get();
        $data = [
            'title' => 'Fundraising',
            'campaign' => $campaign->all()
        ];
        return view('user.fundraising.fundraising',compact('data','getFundraising','campaign','donationByFundraiser'));
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
        $validatedData = $request->validate([
            'campaign_id' => 'required',
        ]);
        $karakter = 'abcdefghijklmnopqrstuvwxyz';
        $referral_code = substr(str_shuffle($karakter), 5, 6);
        $campaignId = $request->campaign_id;
        $fundraising = new Fundraising;
        $getFundraising = $fundraising->CampaignByFundraiser(Auth::user()->id, $request->campaign_id);

        if ($getFundraising->isEmpty()) {
            $store = Fundraising::create([
                'user_id' => Auth::user()->id,
                'campaign_id' => $request->campaign_id,
                'referral_code' => $referral_code,
            ]);        
            if ($store == true) {
                return redirect('/user/fundraising')->with('success','Tambah link fundraising baru berhasil');
            } 
            else{
                return redirect('/user/fundraising')->with('error','Tambah link fundraising baru gagal');
            }
        }
        else {
            return redirect('/user/fundraising')->with('error','Link fundraising telah dibuat sebelumnya');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fundraising  $fundraising
     * @return \Illuminate\Http\Response
     */
    public function show(Fundraising $fundraising)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fundraising  $fundraising
     * @return \Illuminate\Http\Response
     */
    public function edit(Fundraising $fundraising)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fundraising  $fundraising
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fundraising $fundraising)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fundraising  $fundraising
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fundraising $fundraising)
    {
        //
    }
}
