<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Bank;
use App\Models\Payment;
use App\Models\Donation;
use App\Models\UserGrade;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function index(Payment $payment, Donation $donation)
    {
        $data = [
            'title' => 'Payment List',
            'donation' => $donation->all(),
            'payment' => $payment->all()
        ];
        return view('superadmin.payment.payment',compact('data'));
    }

    public function create()
    {

    }


    public function store()
    {
        // 
    }


    public function show()
    {
        // 
    }

    public function edit($id)
    {
        //
    }

    public function update($id)
    {
        $payment = new payment;
        $getPayment = $payment->firstwhere('id', $id);
        $getDonation = $getPayment->donation;
        $getCampaign = $getPayment->donation->campaign;
        $getUserGrade = UserGrade::firstwhere('user_id', $getDonation->user_id);

        if ($getUserGrade) {
            $getUserGrade->update([
                'grade' => $getUserGrade->grade + 1,
            ]);
        } else {
            UserGrade::create([
                'user_id' => $getDonation->user_id,
            ]);
        }
        
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
        
        return redirect()->back()->with('success','Payment confirmation is successfull');;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = Payment::firstWhere('id',$id);
        if ($payment->receipt) {
            Storage::delete($payment->receipt);
        }
        $delete = $payment->delete($id);
        if ($delete) {
            return redirect('/superadmin/payment')->with('success','Delete payment is successful');
        }
        else{
            return redirect('/superadmin/payment')->with('error','Delete payment is failed');
        }
    }

    public function getReceiverInfo(Bank $bank){
        $id =  $_GET['id'];
        $getData = $bank->firstWhere('id', $id) ;
        echo json_encode($getData);
    }
    public function getPaymentInfo(Payment $payment){
        $id =  $_GET['id'];
        $getData = $payment->firstWhere('id', $id) ;
        echo json_encode($getData);
    }
}
