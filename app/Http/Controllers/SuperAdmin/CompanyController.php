<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Company;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
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
        $profile = new Profile;
        $company = new Company;
        $validatedData = $request->validate([
            'company_name' => 'required|max:255',
            'job_title' => 'required|max:255',
        ]);

        $user = Auth::user();
        $getProfileData = $profile->firstWhere('user_id', $user->id);
        $getCompanyData = $company->firstWhere('user_id', $user->id);
        if (empty($getCompanyData) && empty($getProfileData)) {
            $save = Company::create([
                'user_id' => $user->id,
                'company_name' => $validatedData['company_name'],
                'job_title' => $validatedData['job_title'],
            ]);
            $getCompanyId = $company->firstWhere('user_id', $user->id);
            Profile::create([
                'user_id' => $user->id,
                'company_id' => $getCompanyId->id,
            ]);
        }
        elseif (empty($getCompanyData) || empty($getProfileData)) {
            if (empty($getCompanyData)) {
                $save = Company::create([
                    'user_id' => $user->id,
                    'company_name' => $validatedData['company_name'],
                    'job_title' => $validatedData['job_title'],
                ]);
                $getCompanyId = $company->firstWhere('user_id', $user->id);
                $getProfileData->update([
                    'company_id' => $getCompanyId->id,
                ]);
            }
            elseif (empty($getProfileData)) {
                $save = $getCompanyData->update([
                    'company_name' => $validatedData['company_name'],
                    'job_title' => $validatedData['job_title'],
                ]);
                $getCompanyId = $company->firstWhere('user_id', $user->id);
                Profile::create([
                    'user_id' => $user->id,
                    'company_id' => $getCompanyId->id,
                ]);
            }
        }
        elseif (!empty($getCompanyData) && !empty($getProfileData)) {
            $save = $getCompanyData->update([
                'company_name' => $validatedData['company_name'],
                'job_title' => $validatedData['job_title'],
            ]);
            $getCompanyId = $company->firstWhere('user_id', $user->id);
            $getProfileData->update([
                'company_id' => $getCompanyId->id,
            ]);
        }


        if ($save == true) {
            return redirect('/superadmin/settings')->with('success','Update company info is successful');
        }
        else{
            return redirect('/superadmin/settings')->with('error','Update company info is failed');
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
}
