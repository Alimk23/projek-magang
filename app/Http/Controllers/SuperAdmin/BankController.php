<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Bank;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BankController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Bank $bank)
    {
        $user = Auth::user();
        $getBank = $bank->where('user_id',$user->id)->get();
        $data = [
            'title' => 'Bank'
        ];
        return view('superadmin.bank.bank',compact('data', 'getBank'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Profile $profile)
    {
        $user = Auth::user();
        $getProfileData = $profile->firstWhere('user_id', $user->id);
        if ($getProfileData) {
            $data = [
                'title' => 'Add New Bank',
                'user_id' => $user->id
            ];
            return view('superadmin.bank.create-bank',compact('data'));
        } 
        else {
            return redirect('/admin/profile')->with('forbidden','Silahkan lengkapi data profil terlebih dahulu');
        }
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
            'user_id' => 'required|max:255',
            'bank_name' => 'required|max:255',
            'bank_code' => 'required',
            'bank_account' => 'required',
            'alias' => 'required|max:255',
            'bank_logo' => 'required|image|file|max:1024',
        ]);
        if ($request->file('bank_logo')) {
            $validatedData['bank_logo'] = $request->file('bank_logo')->store('bank-logo');
        }

        $store = Bank::create($validatedData);
        if ($store == true) {
            return redirect('/superadmin/bank')->with('success','Add new bank successful');
        }
        else{
            return redirect('/superadmin/bank')->with('error','Add new bank failed');
        }
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
        $user = Auth::user();
        $bank = bank::where('id',$id)->first();
        $data = [
            'title' => 'Edit Bank Info',
            'user_id' => $user->id
        ];
        return view('superadmin.bank.edit-bank',compact('data','bank'));
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
            'user_id' => 'required|max:255',
            'bank_name' => 'required|max:255',
            'bank_code' => 'required',
            'bank_account' => 'required',
            'alias' => 'required|max:255',
            'bank_logo' => 'image|file|max:1024',
        ]);
        $bank = Bank::where('id',$id)->first();

        if ($request->file('bank_logo')) {
            if ($bank->bank_logo) {
                Storage::delete($bank->bank_logo);
            }
            $validatedData['bank_logo'] = $request->file('bank_logo')->store('bank-logo');
        }

        $update = $bank->update($validatedData);

        if ($update == true) {
            return redirect('/superadmin/bank')->with('success','Edit bank is successful');
        }
        else{
            return redirect('/superadmin/bank')->with('error','Edit bank is failed');
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
        $delete = Bank::destroy($id);
        if ($delete) {
            return redirect('/superadmin/bank')->with('success','Delete bank is successful');
        }
        else{
            return redirect('/superadmin/bank')->with('error','Delete bank is failed');
        }
    }
}