<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Bank;
use App\Models\News;
use App\Models\User;
use App\Models\Payment;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PaymentController;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $withdraw = Withdraw::all();
        $campaign = Campaign::all();
        $bank = Bank::all();
        $user = User::all();
        $data = [
            'title' => 'Withdraw Management',
        ];
        return view('superadmin.withdraw.withdraw',compact('data','withdraw','campaign','bank','user')); 
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
        $validatedData = $request->validate([
            'status' => 'required',
        ]);
        $withdraw = Withdraw::where('id',$id)->first();
        $update = $withdraw->update($validatedData);
        if ($request->status == 2) {
            $dateNow = \Carbon\Carbon::now()->timezone('Asia/Jakarta');
            $store = News::create([
                'campaign_id' => $withdraw->campaign_id,
                'title' => 'Pencairan dana sebesar Rp '. currency_format($withdraw->nominal),
                'description' => $withdraw->description,
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ]);
        }
        if ($update == true) {
            return redirect('/superadmin/withdraw')->with('success','Update status withdraw request is successful');
        }
        else{
            return redirect('/superadmin/withdraw')->with('error','Update status withdraw request is failed');
        }
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
            return redirect('/superadmin/contributor')->with('success','Delete contributor is successful');
        }
        else{
            return redirect('/superadmin/contributor')->with('error','Delete contributor is failed');
        }
    }
}
