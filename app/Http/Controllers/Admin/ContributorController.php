<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Payment;
use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Auth;

class ContributorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Donation $donation, User $user)
    {
        $userAuth = Auth::user();
        $getDonation = $donation->all();
        $data = [
            'title' => 'Contributor',
        ];
        return view('admin.donation.contributor',compact('data','getDonation','userAuth', 'user', 'donation')); 
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
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paymentController = new PaymentController;
        $donation = Donation::firstWhere('user_id',$id);
        $payment = Payment::firstWhere('donation_id',$donation->id);
        $user = User::firstWhere('id',$id);
        if ($payment) {
            $delPayment = $paymentController->destroy($payment->id);
        }
        if ($donation) {
            $delDonation = $donation->delete(); 
        }
        $delete = User::destroy($id);
        if ($delete) {
            return redirect('/admin/contributor')->with('success','Delete contributor is successful');
        }
        else{
            return redirect('/admin/contributor')->with('error','Delete contributor is failed');
        }
    }
}
