<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\User;
use App\Models\Payment;
use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
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
            'phone' => 'required',
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
                'email' => $request->email,
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
        $newPayment = Payment::create([
            'donation_id' => $newDonation,
            'order_id' => $order_id,
            'bank_id' => $request->bank,
            'nominal' => $validatedData['nominal'],
        ])->id;
        
        $getDonationData = Donation::find($newDonation);
        $getPaymentData = Payment::find($newPayment);
        $msgUser = "Assalamu'alaikum Kak $request->name, \n\nSepertinya ada donasi kak $request->name untuk program " . $getDonationData->campaign->title . " dengan nominal Rp ".currency_format($getDonationData->nominal). " yang belum selesai \n\nJika sudah, mohon ketersediannya untuk melakukan konfirmasi dengan mengirim bukti transfernya ya kak, agar donasi yang kakak titipkan bisa disalurkan sesuai akad yang kakak amanahkan \n\nAtau jika belum, kak $request->name bisa melanjutkan dengan melakukan transfer melalui Rekening berikut: \n".$getPaymentData->bank->bank_name. " (".($getPaymentData->bank->bank_code) .")\n" .$getPaymentData->bank->bank_account ."\nan.". $getPaymentData->bank->alias. "\n\nSemoga dimudahkan dengan segala urusannya kak $request->name, terima kasih";
        $msgAdmin = "Assalamu'alaikum Kak \n\nAda donasi baru yang masuk nih untuk program " . $getDonationData->campaign->title . " dengan nominal Rp ".currency_format($getDonationData->nominal). " dari: $request->name ($request->phone) yang belum selesai.  \n\nDengan detail pembayaran yang dipilih berupa transfer bank melalui Rekening berikut: \n".$getPaymentData->bank->bank_name. " (".($getPaymentData->bank->bank_code) .")\n" .$getPaymentData->bank->bank_account ."\nan.". $getPaymentData->bank->alias. "\n\nHobiSedekah Notification";
        $this->sendMessage($request->phone, $msgUser);
        $this->sendMessage($getDonationData->campaign->user->phone, $msgAdmin);

        return redirect('/payment/'.$order_id);
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
