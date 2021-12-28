<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Category;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Campaign $campaign){
        $data = [
            'title' => 'Beranda',
            'campaign' => $campaign->all()
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
    public function show($slug, Campaign $campaign){
        $detail = $campaign->firstwhere('slug', $slug);
        $data = [
            'title' => $detail->title,
            'details' => $detail,
        ];
        return view('user.show-campaign', compact('data'));
    }
}
