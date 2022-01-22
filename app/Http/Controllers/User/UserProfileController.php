<?php

namespace App\Http\Controllers\User;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = Auth::user();
        $profile = UserProfile::where('user_id',$auth->id)->first();
        $data = [
            'title' => 'Profil Saya'
        ];
        return view('user.profile.profile', compact('data','auth','profile'));
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
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function show(UserProfile $userProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(UserProfile $userProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'photo' => 'image|file|max:1024',
        ]);
        $validatedData['user_id'] = $id;
        $userProfile = UserProfile::where('user_id',$id)->first();
        if ($userProfile) {
            if ($userProfile->photo) {
                Storage::delete($userProfile->photo);
            }
            $validatedData['photo'] = $request->file('photo')->store('profile-image');
            
            $update = $userProfile->update($validatedData);
        }
        else {
            if ($request->file('photo')) {
                $validatedData['photo'] = $request->file('photo')->store('profile-image');
            }
            $update = UserProfile::create($validatedData);
        }
        
        if ($update == true) {
            return redirect('/user/profile')->with('success','Update foto profil berhasil');
        }
        else{
            return redirect('/user/profile')->with('error','Update foto profil gagal');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserProfile $userProfile)
    {
        //
    }
}
