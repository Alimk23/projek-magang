<?php

namespace App\Http\Controllers\User;

use App\Models\Bank;
use App\Models\User;
use App\Models\Payment;
use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DonationController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getDonation = Donation::where('user_id', Auth::user()->id)->get();
        $data = [
            'title' => 'Donasi Saya',
        ];
        return view('user.donation.donation',compact('data','getDonation'));
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
        // 
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
        // get data bank dari user yang membuat campaign
        // $getBank = $bank->where('user_id', $detail->user_id)->get();
        
        // get data bank dari Super Admin id 1
        $getBank = $bank->where('user_id', 1)->get();
        
        $data = [
            'title' => 'Create Payment',
            'details' => $detail,
            'banks' => $getBank,
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
        $payment = new payment;
        $getPayment = $payment->firstwhere('id', $id);
        $getDonation = $getPayment->donation;
        $getCampaign = $getPayment->donation->campaign;

        $updateCampaign = $getCampaign->update([
            'collected' => $getCampaign->collected + $getDonation->nominal
        ]);
        $updateDonation = $getDonation->update([
            'status' => 1
        ]);
        if ($getPayment->receipt) {
            Storage::delete($getPayment->receipt);
        }
        $delPayment = $getPayment->delete();

        return redirect()->back()->with('success','Donation confirmation is successfull');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = Payment::firstWhere('donation_id',$id);
        if ($payment) {
            $del = $payment->delete(); 
        }
        $delete = Donation::destroy($id);
        if ($delete) {
            return redirect('/admin/donation')->with('success','Delete donation is successful');
        }
        else{
            return redirect('/admin/donation')->with('error','Delete donation is failed');
        }
    }
    public function getCampaign($key, $value){
        $campaign = new Campaign;
        $getCampaign = $campaign->firstwhere($key, $value);
        return $getCampaign;
    }
    public function getUser($key, $value){
        $user = new User;
        $getUser = $user->firstwhere($key, $value);
        return $getUser;
    }
}
