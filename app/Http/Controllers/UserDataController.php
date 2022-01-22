<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Profile;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserDataController extends Controller
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:255',
        ]);
        $user = User::find($id);
        $update = $user->update($validatedData);

        if ($update == true) {
            if ($user->role == 0) {
                return redirect('/superadmin/settings')->with('success','Edit login info is successful');
            }
            if ($user->role == 2) {
                return redirect('/user/profile')->with('success','Edit profil berhasil');
            }
        }
        else{
            return redirect()->back()->with('error','Edit login info is failed');
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
        //
    }

    public function getLoginInfo(User $user){
        $id =  $_GET['id'];
        $getData = $user->firstWhere('id', $id) ;
        echo json_encode($getData);
    }
    public function getProfileInfo(Profile $profile){
        $id =  $_GET['id'];
        $getData = $profile->firstWhere('user_id', $id) ;
        echo json_encode($getData);
    }
    public function getCompanyInfo(Company $company){
        $id =  $_GET['id'];
        $getData = $company->firstWhere('user_id', $id) ;
        echo json_encode($getData);
    }
    public function getWithdrawInfo(Withdraw $withdraw){
        $id =  $_GET['id'];
        $getData = $withdraw->firstWhere('id', $id) ;
        echo json_encode($getData);
    }
}
