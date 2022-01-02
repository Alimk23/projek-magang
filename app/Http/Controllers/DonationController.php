<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\User;
use App\Models\Payment;
use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCampaign($id){
        $campaign = new Campaign;
        $getCampaign = $campaign->firstwhere('id', $id);
        return $getCampaign;
    }
    public function getUser($id){
        $user = new User;
        $getUser = $user->firstwhere('id', $id);
        return $getUser;
    }
    public function index(Donation $donation,Campaign $campaign,User $user)
    {
        $data = [
            'title' => 'Donation',
            'donation'=> $donation->all(),
            'getCampaign' => $campaign,
            'getUser' => $user,
        ];
        return view('admin.donation',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Donation $donation,Payment $payment, User $user)
    {
        $validatedData = $request->validate([
            'campaign_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'nominal' => 'required|integer',
            'bank' => 'required',
            'message' => 'required',
        ]);
        $order_id = mt_rand(100000,999999);

        $userData = $user->firstwhere('phone', $request->phone);
        if ($userData) {
            $user_id = $userData->id;
        } else {
            $newUser = User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
            ]);
            $newUserData = $user->firstwhere('phone', $request->phone);
            $user_id = $newUserData->id;
        }

        if (!empty($request->anonim)) {
            $newDonation = Donation::create([
                'campaign_id' => $request->campaign_id,
                'user_id' => $user_id,
                'anonim' => $request->anonim,
                'order_id' => $order_id,
                'nominal' => $request->nominal,
                'message' => $request->message,
                'status' => 0,
            ]);
        } else {
            $newDonation = Donation::create([
                'campaign_id' => $request->campaign_id,
                'user_id' => $user_id,
                'order_id' => $order_id,
                'nominal' => $request->nominal,
                'message' => $request->message,
                'status' => 0,
            ]);
        }

        $donationData = $donation->firstwhere('order_id', $order_id);
        $newPayment = Payment::create([
            'donation_id' => $donationData->id,
            'order_id' => $donationData->order_id,
            'bank_id' => $request->bank,
            'nominal' => $donationData->nominal,
        ]);
        
        $paymentData = $payment->firstwhere('order_id', $order_id);
        
        return redirect('/payment/'.$paymentData->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Campaign $campaign,Bank $bank)
    {
        $detail = $campaign->firstwhere('id', $id);
        
        $data = [
            'title' => 'Create Payment',
            'details' => $detail,
            'banks' => $bank->all(),
        ];
        return view('user.create-donation', compact('data'));
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
    public function update($id)
    {
        $donation = new Donation;
        $campaign = new Campaign;
        $getDonation = $donation->firstwhere('id', $id);
        $getCampaign = $campaign->firstwhere('id', $getDonation->campaign_id);
        $getDonation->update([
            'status' => 2
        ]);
        $getCampaign->update([
            'collected' => $getCampaign->collected + $getDonation->nominal
        ]);

        return redirect('donation')->with('success','Payment confirmation is successfull');;
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
