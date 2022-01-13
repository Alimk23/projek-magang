<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use App\Models\Profile;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Donation;
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

    public function show($slug, Campaign $campaign, Donation $donation, Profile $profile, News $news){
        $user = new User();
        $getCampaign = $campaign->where('slug', $slug)->first();
        $getDonation = $donation->where('campaign_id', $getCampaign->id)->get();
        $getNews = $news->where('campaign_id', $getCampaign->id)->get();
        $getProfile = $profile->where('user_id', $getCampaign->user_id)->first();
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
        ];
        return view('user.show-campaign', compact('data'));
    }
}
