<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Profile;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserDataController extends Controller
{
    public function resetPassword(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255',
            'old_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = User::where('email', $request->email)->first();
        $validationOldPassword = Hash::check($request->old_password, $user->password);
        if ($validationOldPassword) {
            $update = $user->update([                
                'password' => Hash::make($request->password),
            ]);
            if ($update) {
                return redirect()->back()->with('success','Reset password berhasil');
            }
            else {
                return redirect()->back()->with('error','Maaf, terjadi kesalahan sistem. Reset password gagal');
            }
        }
        else {
            return redirect()->back()->with('error','Password lama tidak sama dengan yang berada di database kami');
        }
    }

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
