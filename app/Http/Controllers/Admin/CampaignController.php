<?php

namespace App\Http\Controllers\Admin;

use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use App\Models\CategoryByUser;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class CampaignController extends Controller
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
    public function index(Campaign $campaign)
    {
        $user = Auth::user();
        $getCampaign = $campaign->where('user_id',$user->id)->get();

        $data = [
            'title'=>'Campaign',
            'campaign'=>$getCampaign
        ];
        return view('admin.campaign.campaign',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Profile $profile)
    {
        $user = Auth::user();
        $getProfileData = $profile->firstWhere('user_id', $user->id);
        if ($getProfileData) {
            $getCategory = Category::all();
            $photo = $getProfileData->photo;
            $data = [
                'title' => 'Create Campaign',
                'category' => $getCategory
            ];
            return view('admin.campaign.create-campaign',compact('data'));
        } 
        else {
            return redirect('/admin/profile')->with('forbidden','Silahkan lengkapi data profil terlebih dahulu');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:campaign',
            'target' => 'required',
            'end_date' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'caption' => 'required',
            'cover' => 'image|file|max:1024',
            'files' => 'file|max:1024',
        ]);
        $user = Auth::user();
        $validatedData['user_id'] = $user->id;

        if ($request->file('cover')) {
            $validatedData['cover'] = $request->file('cover')->store('cover-image');
        }
        if ($request->file('files')) {
            $validatedData['files'] = $request->file('files')->store('files-image');
        }

        $store = Campaign::create($validatedData);
        if ($store == true) {
            return redirect('/admin/campaign')->with('success','Add new campaign successful');
        }
        else{
            return redirect('/admin/campaign')->with('error','Add new campaign failed');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $campaign = Campaign::where('id',$id)->first();
        $getCategory = Category::all();
        $data=[
            'title'=>'Edit Campaign',
            'category' => $getCategory
        ];
        return view('admin.campaign.edit-campaign', compact('data','campaign'));
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
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required',
            'target' => 'required',
            'end_date' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'caption' => 'required',
            'cover' => 'image|file|max:1024',
            'files' => 'file|max:1024',
        ]);
        $validatedData['status'] = 0;
        $campaign = Campaign::where('id',$id)->first();

        if ($request->file('cover')) {
            if ($campaign->cover) {
                Storage::delete($campaign->cover);
            }
            $validatedData['cover'] = $request->file('cover')->store('cover-image');
        }
        if ($request->file('files')) {
            if ($campaign->files) {
                Storage::delete($campaign->files);
            }
            $validatedData['files'] = $request->file('files')->store('files-image');
        }
        $update = $campaign->update($validatedData);

        if ($update == true) {
            return redirect('/admin/campaign')->with('success','Edit campaign is successful');
        }
        else{
            return redirect('/admin/campaign')->with('error','Edit campaign is failed');
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
        $donation = Donation::firstWhere('campaign_id',$id);
        if ($donation) {
            $del = $donation->delete(); 
        }
        $delete = Campaign::destroy($id);
        if ($delete) {
            return redirect('/admin/campaign')->with('success','Delete campaign is successful');
        }
        else{
            return redirect('/admin/campaign')->with('error','Delete campaign is failed');
        }
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Campaign::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}