<?php

namespace App\Http\Controllers;

use Closure;
use App\Models\News;
use App\Models\User;
use App\Models\Company;
use App\Models\Profile;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Donation;
use App\Models\Fundraising;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\CustomerService;
use Dflydev\DotAccessData\Data;
use App\Models\CampaignByFundraiser;
use App\Models\RegistrationStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index(Campaign $campaign, Donation $donation, Category $category){
        $collectedDonation = Campaign::select('collected')->pluck('collected')->all();
        if (!empty($collectedDonation)) {
            $totalDonation = array_sum($collectedDonation);
        } else {
            $totalDonation = 0;
        }

        $data = [
            'title' => 'Beranda',
            'campaign' => $campaign->all(),
            'donation' => $donation->all(),
            'category' => $category->all(),
            'totalDonation' => $totalDonation,
        ];
        return view('index',compact('data'));
    }

    public function redirectUrl(){
        if (Auth::check()) {
            $user = Auth::user();
            $RegistrationStatus = RegistrationStatus::where('user_id',$user->id)->with('user')->firstOrFail();
            if (!empty($RegistrationStatus)) {
                if ($RegistrationStatus->status == 0) {
                    return redirect('/organization/status');
                }
                else {                
                    if ($user->role == 0) {
                        return redirect('/superadmin');
                    }
                    if ($user->role == 1) {
                        return redirect('/admin');
                    }
                    if ($user->role == 2) {
                        return redirect('/user');
                    }
                }
            }
            else {                
                if ($user->role == 0) {
                    return redirect('/superadmin');
                }
                if ($user->role == 1) {
                    return redirect('/admin');
                }
                if ($user->role == 2) {
                    return redirect('/user');
                }
            }
        }
        else {
            return redirect('/login')->with('error','Silahkan masuk kembali');
        }
    }
    

    public function show($slug, Campaign $campaign, Donation $donation, Profile $profile, News $news, CustomerService $customerService, UserProfile $userProfile){
        $user = new User();
        $ref = !empty($_GET['ref']) ? $_GET['ref'] : '';
        $getCampaign = $campaign->where('slug', $slug)->first();
        $fundraising = Fundraising::where('campaign_id',$getCampaign->id)->get();
        $getDonation = $donation->where('campaign_id', $getCampaign->id)->get();
        $getNews = $news->where('campaign_id', $getCampaign->id)->get();
        $getProfile = $profile->where('user_id', $getCampaign->user_id)->first();
        $getCS = $customerService->where('id', $getCampaign->cs_id)->first();
        if (empty($getProfile)) {
            $photo = null;
        } else {
            $photo = $getProfile->photo;
        }
        
        $data = [
            'title' => $getCampaign->title,
            'campaign' => $getCampaign,
            'getDonation' => $getDonation,
            'getNews' => $getNews,
            'user'=>$user,
            'photo'=>$photo,
            'userProfile'=>$userProfile,
            'cs'=>$getCS,
            'ref'=> $ref,
        ];
        return view('user.show-campaign', compact('data','fundraising'));
    }

    public function createOrganization(){
        $data = [
            'title' => 'Pendaftaran Lembaga Baru'
        ];
        return view('user.create-organization', compact('data'));
    }
    public function storeOrganization(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|',
            'email' => 'required|string|max:255|email|unique:users',
            'phone' => 'required|max:13|unique:users',
            'password' => 'required|string|min:8|confirmed|',
            'company_name' => 'required',
            'job_title' => 'required',
            'address' => 'required',
            'photo' => 'image|file|max:1024',
        ]);
        if ($request->file('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('profile-image');
            $photo = $validatedData['photo'];
        }else {
            $photo = null;
        }
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'role' => 1,
            'password' => Hash::make($validatedData['password']),
        ])->id;
        
        $company = Company::create([
            'user_id' => $user,
            'company_name' => $validatedData['company_name'],
            'job_title' => $validatedData['job_title'],
        ])->id;
        
        $profile = Profile::create([
            'user_id' => $user,
            'company_id' => $company,
            'photo' => $photo,
            'address' => $validatedData['address'],
        ]);
        $RegistrationStatus = RegistrationStatus::create([
            'user_id' => $user
        ])->id;

        if ($RegistrationStatus == true) {
            return redirect('/login')->with('success','Pengajuan registrasi lembaga berhasil. Silahkan login untuk melihat status pendaftaran');
        }
        else{
            return redirect()->back()->with('error','Pengajuan registrasi lembaga gagal. Terjadi kesalahan pada sistem');
        }
    }
    public function statusOrganization(){
        $id = Auth::user()->id;
        $RegistrationStatus = RegistrationStatus::where('user_id',$id)->with('user')->firstOrFail();
        return view('user.status-organization',compact('RegistrationStatus'));
    }
}
