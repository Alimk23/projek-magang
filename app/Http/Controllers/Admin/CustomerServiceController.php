<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\CustomerService;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Support\Facades\Auth;

class CustomerServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CustomerService $customerService)
    {
        $user = Auth::user();
        $getCustomerService = $customerService->where('user_id',$user->id)->get();
        $data = [
            'title'=>'Customer Service',
            'customerService'=>$getCustomerService
        ];
        return view('admin.customer-service.customer-service',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $data = [
            'title' => 'Add New Customer Service',
            'user_id' => $user->id
        ];
        return view('admin.customer-service.create-customer-service',compact('data'));
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
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required',
        ]);
        $store = CustomerService::create($validatedData);
        if ($store == true) {
            return redirect('/admin/customer-service')->with('success','Add new customer service successful');
        }
        else{
            return redirect('/admin/customer-service')->with('error','Add new customer service failed');
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
        $customerService = CustomerService::where('id',$id)->first();
        $data = [
            'title' => 'Edit Customer Service',
            'user_id' => $user->id
        ];
        return view('admin.customer-service.edit-customer-service',compact('data','customerService'));

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
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required',
        ]);
        $customerService = CustomerService::where('id',$id)->first();
        $update = $customerService->update($validatedData);
        if ($update == true) {
            return redirect('/admin/customer-service')->with('success','Update customer service successful');
        }
        else{
            return redirect('/admin/customer-service')->with('error','Update customer service failed');
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
        $campaign = new Campaign;
        $getCampaign = $campaign->where('cs_id',$id)->first();
        $data = [
            'cs_id' => null,
            'status' => 4,
        ];
        if ($getCampaign) {
            $getCampaign->update($data);
        }
        $delete = CustomerService::destroy($id);
        if ($delete) {
            return redirect('/admin/customer-service')->with('success','Delete customer service is successful');
        }
        else{
            return redirect('/admin/customer-service')->with('error','Delete customer service is failed');
        }
    }
    public function getCSInfo(CustomerService $customerService){
        $id =  $_GET['id'];
        $getData = $customerService->firstWhere('id', $id) ;
        echo json_encode($getData);
    }
}
