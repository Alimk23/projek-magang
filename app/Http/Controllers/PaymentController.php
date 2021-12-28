<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Payment;
use App\Models\User;
use Dflydev\DotAccessData\Data;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Dashboard'
        ];
        return view('admin.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Donation $donation, Campaign $campaign, Bank $bank)
    {
        $donation_id = session()->get('donation_id');
        $bank_id = session()->get('bank_id');
        $user_id = session()->get('user_id');
        $getDonation = $donation->firstwhere('id', $donation_id);
        $getBank = $bank->firstwhere('id', $bank_id);
        dd();
        // $data = [
        //     'donations' => $getDonation,
        //     'banks' => $getBank,
        // ];
        // return view('user.create-payment', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Donation $donation, User $user)
    {
        $validatedData = $request->validate([
            'campaign_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'nominal' => 'required',
            'bank' => 'required',
            'message' => 'required',
        ]);
        $newUser = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);
        $user = $user->firstwhere('phone', $request->phone);

        if (!empty($request->anonim)) {
            $newDonation = Donation::create([
                'campaign_id' => $request->campaign_id,
                'user_id' => $user->id,
                'anonim' => $request->anonim,
                'order_id' => mt_rand(100000,999999),
                'nominal' => $request->nominal,
                'message' => $request->message,
                'status' => 0,
            ]);
        } else {
            $newDonation = Donation::create([
                'campaign_id' => $request->campaign_id,
                'user_id' => $user->id,
                'order_id' => mt_rand(100000,999999),
                'nominal' => $request->nominal,
                'message' => $request->message,
                'status' => 0,
            ]);
        }

        return view('user.create-payment');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($payment_id)
    {
        $donation = new Donation;
        $campaign = new Campaign;
        $bank = new Bank;
        $payment = new Payment;
        $getPayment = $payment->firstwhere('id', $payment_id);

        $getDonation = $donation->firstwhere('id', $getPayment->donation_id);
        $getBank = $bank->firstwhere('id', $getPayment->bank_id);
        $data = [
            'donations' => $getDonation,
            'banks' => $getBank,
            'payments' => $getPayment,
        ];
        return view('user.create-payment', compact('data'));
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
    public function update(Request $request, $payment_id)
    {
        $payment = new Payment;
        $donation = new Donation;

        $validatedData = $request->validate([
            'receipt' => 'image|file|max:1024',
        ]);
        if ($request->file('receipt')) {
            $validatedData['receipt'] = $request->file('receipt')->store('receipt-image');
        }

        $getPayment = $payment->firstwhere('id', $payment_id);
        $getPayment->update([
            'path_image' => $validatedData['receipt']
        ]);
        $getDonation = $donation->firstwhere('id', $getPayment->donation_id);
        $getDonation->update([
            'status' => 1
        ]);
        $data = [
            'donations' => $getDonation,
            'payments' => $getPayment,
        ];
        return view('user.status-payment', compact('data'));
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
