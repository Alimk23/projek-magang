<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Company;
use App\Models\Payment;
use App\Models\Profile;
use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CampaignByFundraiser;
use App\Models\DonationByFundraiser;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PaymentController;
use App\Models\Fundraising;

class FundraiserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, Campaign $campaign)
    {
        $auth = Auth::user();
        $DonationByFundraiser = new DonationByFundraiser;
        $fundraising = Fundraising::all();
        $data = [
            'title' => 'Fundraiser',
        ];
        return view('admin.user-data.fundraiser',compact('data','user','auth','campaign','DonationByFundraiser','fundraising')); 
    }
}
