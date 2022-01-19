<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bank;
use App\Models\Campaign;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use App\Models\CustomerService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $withdraw = Withdraw::where('user_id',Auth::user()->id)->get();
        $data = [
            'title' => 'Withdraw Management',
        ];
        return view('admin.withdraw.withdraw',compact('data','withdraw')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $campaign = Campaign::where('user_id',$user->id)->get();
        $bank = Bank::where('user_id',$user->id)->get();
        $data = [
            'title' => 'Add New Withdraw Request',
            'user_id' => $user->id,
            'campaign' => $campaign,
            'bank' => $bank
        ];
        return view('admin.withdraw.create-withdraw',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'campaign_id' => 'required',
            'bank_id' => 'required',
            'nominal' => 'required',
            'description' => 'required',
        ]);
        $store = Withdraw::create($validatedData);
        if ($store == true) {
            return redirect('/admin/withdraw')->with('success','Add new withdraw request successful');
        }
        else{
            return redirect('/admin/withdraw')->with('error','Add new withdraw request failed');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerService  $customerService
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerService $customerService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerService  $customerService
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $withdraw = Withdraw::find($id)->first();
        $data = [
            'title' => 'Edit Withdraw Request',
            'user_id' => $user->id
        ];
        return view('admin.customer-service.edit-customer-service',compact('data','withdraw'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerService  $customerService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'campaign_id' => 'required',
            'bank_id' => 'required',
        ]);
        $withdraw = Withdraw::find($id)->first();
        $update = $withdraw->update($validatedData);
        if ($update == true) {
            return redirect('/admin/withdraw')->with('success','Edit withdraw request successful');
        }
        else{
            return redirect('/admin/withdraw')->with('error','Edit withdraw request failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerService  $customerService
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Withdraw::destroy($id);
        if ($delete) {
            return redirect('/admin/withdraw')->with('success','Delete withdraw request successful');
        }
        else{
            return redirect('/admin/withdraw')->with('error','Delete withdraw request failed');
        }
    }
}