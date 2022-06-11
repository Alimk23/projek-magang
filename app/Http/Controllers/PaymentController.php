<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\User;
use App\Models\Payment;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\HistoryPayment;
use Illuminate\Http\Request;
use Dflydev\DotAccessData\Data;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
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
    public function show($order_id)
    {
        $bank = new Bank;
        $payment = new Payment;
        $getPayment = Payment::firstOrFail()->where('order_id', $order_id)->first();
        $getDonation = $getPayment->donation;
        $getBank = Bank::firstOrFail()->where('id', $getPayment->bank_id)->first();
        $data = [
            'getDonation' => $getDonation,
            'getBank' => $getBank,
            'getPayment' => $getPayment,
        ];
        return view('user.create-payment', compact('data','getPayment','getDonation','getBank'));
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
            'receipt' => 'required|image|file|max:1024',
        ]);
        if ($request->file('receipt')) {
            $validatedData['receipt'] = $request->file('receipt')->store('receipt-image');
        }

        $getPayment = $payment->firstwhere('id', $payment_id);
        $getPayment->update([
            'receipt' => $validatedData['receipt'],
            'status' => 1,
        ]);        
        return redirect('/status/'. $getPayment->order_id);
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

    public function status($order_id){
        $getPayment = Payment::where('order_id', $order_id)->get();
        if (!empty($getPayment)) {            
            $data = [
                'getPayment' => $getPayment
            ];
        } else {
            $getHistoryPayment = HistoryPayment::where('order_id', $order_id)->get();
            $data = [
                'getPayment' => $getHistoryPayment
            ];
        }
        return view('user.status-payment', compact('data'));
    }
}
