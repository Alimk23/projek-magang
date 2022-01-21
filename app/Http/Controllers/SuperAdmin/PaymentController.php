<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Bank;
use App\Models\Payment;
use App\Models\Donation;
use App\Models\UserGrade;
use App\Http\Controllers\Controller;
use App\Models\DonationByFundraiser;
use App\Models\Fundraising;
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
        $fundraising_id = DonationByFundraiser::where('donation_id', $getDonation->id)->first()->fundraising_id;
        $getFundraising = Fundraising::where('id', $fundraising_id)->first();
        $getCampaign = $getPayment->donation->campaign;
        $getUserGrade = UserGrade::firstwhere('user_id', $getDonation->user_id);
        $donationGradeUpdate = 1;
        $nominal = $getDonation->nominal;
        if ($nominal >= 500000) {
            $amountGrade = 'B';
        }else {
            $amountGrade = 'A';
        }

        if ($getUserGrade) {
            if ($nominal > $getUserGrade->amount_max) {
                $amountMaxUpdate = $nominal;
                $amountGradeUpdate = 'B';
            } else {
                $amountMaxUpdate = $getUserGrade->amount_max;
                $amountGradeUpdate = $getUserGrade->amount_grade;
            }

            if ($getUserGrade->donation_total >= 3) {
                $donationGradeUpdate = 2;
            }
            $getUserGrade->update([
                'donation_total' => $getUserGrade->donation_total + 1,
                'amount_max' => $amountMaxUpdate,
                'donation_grade'=> $donationGradeUpdate,
                'amount_grade'=> $amountGradeUpdate,
            ]);
        } else {
            UserGrade::create([
                'user_id' => $getDonation->user_id,
                'amount_max'=> $nominal,
                'amount_grade'=> $amountGrade,
            ]);
        }
        
        $updateCampaign = $getCampaign->update([
            'collected' => $getCampaign->collected + $getDonation->nominal
        ]);
        $updateDonation = $getDonation->update([
            'status' => 1
        ]);
        $updateFundraising = $getFundraising->update([
            'total' => $getFundraising->total + $getDonation->nominal
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
