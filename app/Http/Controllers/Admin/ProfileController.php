<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
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
    public function index(Profile $profile)
    {
        $user = Auth::user();
        $getProfileData = $profile->firstWhere('user_id', $user->id);
        $name = $user->name ? $user->name : "Belum ada data";
        $email = $user->email ? $user->email : "Belum ada data";
        $phone = $user->phone ? $user->phone : "Belum ada data";
        if (!empty($getProfileData)) {
            $photo = $getProfileData->photo ? $getProfileData->photo : "Belum ada data";
            $address = $getProfileData->address ? $getProfileData->address : "Belum ada data";
            $company_name = $getProfileData->company_id ? $getProfileData->company->company_name : "Belum ada data";
            $job_title = $getProfileData->company_id ? $getProfileData->company->job_title : "Belum ada data";
        } else {
            $photo = "Belum ada data";
            $address = "Belum ada data";
            $company_name = "Belum ada data";
            $job_title = "Belum ada data";            
        }
        
        
        $data = [
            'title' => 'Profile',
            'id'  => $user->id,
            'name'  => $user->name,
            'email'  => $user->email,
            'phone'  => $user->phone,
            'photo'  => $photo,
            'address'  => $address,
            'company_name'  => $company_name,
            'job_title'  => $job_title,
            
        ];
        return view('admin.profile',compact('data'));
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
        $profile = new Profile;
        $validatedData = $request->validate([
            'address' => 'required|max:255',
            'photo' => 'image|file|max:1024',
        ]);
        if ($request->file('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('profile-image');
        }
        $user = Auth::user();
        $getProfileData = $profile->firstWhere('user_id', $user->id);
        
        if (empty($getProfileData)) {            
            $save = Profile::create([
                'user_id' => $id,
                'address' => $validatedData['address'],
                'photo' => $validatedData['photo'],
            ]);
        } else {
            if (empty($request->photo)) {
                $save = $getProfileData->update([
                    'address' => $validatedData['address'],
                ]);
            } else {
                $save = $getProfileData->update([
                    'address' => $validatedData['address'],
                    'photo' => $validatedData['photo'],
                ]);
            }            
        }
        

        if ($save == true) {
            return redirect('/profile')->with('success','Update profile is successful');
        }
        else{
            return redirect('/profile')->with('error','Update profile is failed');
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
}