<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use App\Models\Profile;
use App\Models\Campaign;
use App\Models\CampaignByFundraiser;
use App\Models\Category;
use App\Models\CustomerService;
use App\Models\Donation;
use App\Models\Fundraising;
use Closure;
use Illuminate\Http\Request;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();
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
    

    public function show($slug, Campaign $campaign, Donation $donation, Profile $profile, News $news, CustomerService $customerService){
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
            'cs'=>$getCS,
            'ref'=> $ref,
        ];
        return view('user.show-campaign', compact('data','fundraising'));
    }
}
