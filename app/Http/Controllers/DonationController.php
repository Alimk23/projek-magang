<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use App\Models\Bank;
use App\Models\User;
use App\Models\Payment;
use App\Models\Campaign;
use App\Models\Donation;
use App\Jobs\SendWhatsapp;
use App\Models\Fundraising;
use Illuminate\Http\Request;
use App\Models\CustomerService;
use App\Models\DonationByFundraiser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DonationController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Donation $donation,Campaign $campaign,Payment $payment,User $user)
    {
        $data = [
            'title' => 'Donation',
            'donation'=> $donation->all(),
            'getCampaign' => $campaign,
            'getUser' => $user,
            'getPayment' => $payment,
        ];
        return view('admin.donation.donation',compact('data'));
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
            'phone' => 'required|min:10|max:13|regex:/(08)[0-9]{9}/',
            'nominal' => 'required|integer',
            'bank' => 'required',
        ]);
        $order_id = "HB-". mt_rand(000000,999999);
        $userData = $user->firstwhere('phone', $request->phone);
        if ($userData) {
            $user_id = $userData->id;
        } else {
            $newUser = User::create([
                'name' => $request->name,
                'phone' => $request->phone,
            ])->id;
            $user_id = $newUser;
        }
        if (!empty($request->anonym)) {
            $newDonation = Donation::create([
                'campaign_id' => $validatedData['campaign_id'],
                'user_id' => $user_id,
                'anonym' => $request->anonym,
                'nominal' => $validatedData['nominal'],
                'message' => $request->message,
            ])->id;
        } else {
            $newDonation = Donation::create([
                'campaign_id' => $validatedData['campaign_id'],
                'user_id' => $user_id,
                'nominal' => $validatedData['nominal'],
                'message' => $request->message,
            ])->id;
        }
        if ($newDonation) {
            if (!empty($request->ref)) {
                $getFundraiser = Fundraising::where('referral_code',$request->ref)->first();
                DonationByFundraiser::create([
                    'fundraising_id' => $getFundraiser->id,
                    'donation_id' => $newDonation,
                ]);
            }
            $newPayment = Payment::create([
                'donation_id' => $newDonation,
                'order_id' => $order_id,
                'bank_id' => $request->bank,
                'nominal' => $validatedData['nominal'],
            ])->id;
            $getDonationData = Donation::whereId($newDonation)->with('campaign')->first();
            $csData = CustomerService::whereId($getDonationData->campaign->cs_id)->first();
            $phoneCS = $csData->phone ? $csData->phone : null;
            $emailCS = $csData->email ? $csData->email : null;
            $getPaymentData = Payment::find($newPayment);

            // $phone = whatsapp_format($request->phone);    
            // $msgAdmin = "Assalamu'alaikum Kak \n\nAda donasi baru yang masuk nih untuk program " . $getDonationData->campaign->title . " dengan nominal Rp ".currency_format($getDonationData->nominal). " dari: $request->name ($request->phone) yang belum selesai.  \n\nDengan detail pembayaran yang dipilih berupa transfer bank melalui Rekening berikut: \n".$getPaymentData->bank->bank_name. " (".($getPaymentData->bank->bank_code) .")\n" .$getPaymentData->bank->bank_account ."\nan.". $getPaymentData->bank->alias. "\n\nJika ingin mengingatkan donatur tersebut, bisa lewat kontak whatsapp berikut ini: \nhttps://wa.me/". $phone ." \n\nHobi Sedekah Notification";
            // if (!empty($phoneCS)) {
            //     $sendtoAdmin = SendWhatsapp::dispatch($phoneCS,$msgAdmin);
            // }
            // if (!empty($emailCS)) {
            //     $emailData = [
            //         'title' => 'Donasi Baru Diterima',
            //         'order_id' => $order_id,
            //         'nominal' => currency_format($validatedData['nominal']),
            //         'name' => $request->name,
            //         'phone' => whatsapp_format($request->phone),
            //         'created_at' => date_format($getDonationData->created_at,"d M Y | H:i")
            //     ];
            //     SendMailJob::dispatch($emailCS, $emailData);
            // }
            return redirect('/payment/'.$order_id);
        }
        else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Campaign $campaign,Bank $bank)
    {
        $ref =  !empty($_GET['ref']) ? $_GET['ref'] : '';
        $auth = null;
        $detail = $campaign->firstwhere('id', $id);
        // get data bank dari Super Admin id 1
        $getBank = $bank->where('user_id', 1)->get();
        if (Auth::check() && Auth::user()->role == 2) {
            $auth = Auth::user();
        }
        $data = [
            'title' => 'Create Payment',
            'details' => $detail,
            'banks' => $getBank,
            'ref' => $ref,
        ];
        return view('user.create-donation', compact('data','auth'));
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
