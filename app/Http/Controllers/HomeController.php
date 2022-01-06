<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Category;
use App\Models\Donation;
use App\Models\Profile;
use App\Models\User;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
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

    public function checkRole()
    {
        $user = Auth::user();
        
        if ($user->role == 0) {
            return redirect('/admin');
        }
        if ($user->role == 1) {
            return redirect('/user');
        }
    }
    public function show($slug, Campaign $campaign, Donation $donation, Profile $profile){
        $user = new User();
        $detail = $campaign->firstwhere('slug', $slug);
        $getDonation = Donation::where('campaign_id', $detail->id)->get();
        $getProfile = $profile->firstwhere('user_id', $detail->user_id);
        if (empty($getProfile)) {
            $photo = null;
        } else {
            $photo = $getProfile->photo;
        }
        
        $data = [
            'title' => $detail->title,
            'campaign' => $detail,
            'getDonation' => $getDonation,
            'user'=>$user,
            'photo'=>$photo,
        ];
        return view('user.show-campaign', compact('data'));
    }
}
