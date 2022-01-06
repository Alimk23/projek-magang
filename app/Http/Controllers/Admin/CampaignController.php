<?php

namespace App\Http\Controllers\Admin;

use App\Models\Campaign;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoryByUser;
use Illuminate\Support\Facades\Auth;
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
        return view('admin.campaign',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CategoryByUser $categoryByUser)
    {
        $user = Auth::user();
        $getCategory = $categoryByUser->where('user_id',$user->id)->get();
        $data = [
            'title' => 'Create Campaign',
            'category' => $getCategory
        ];
        return view('admin.create-campaign',compact('data'));
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
            'description' => 'required',
            'caption' => 'required',
            'cover' => 'image|file|max:1024',
            'files' => 'file|max:1024',
        ]);
        $validatedData['category_id'] = 1;
        $validatedData['fundraiser'] = "Penggalang Dana";

        if ($request->file('cover')) {
            $validatedData['cover'] = $request->file('cover')->store('cover-image');
        }
        if ($request->file('files')) {
            $validatedData['files'] = $request->file('files')->store('files-image');
        }

        $store = Campaign::create($validatedData);
        if ($store == true) {
            return redirect('campaign')->with('success','Add new campaign successful');
        }
        else{
            return redirect('campaign')->with('error','Add new campaign failed');
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
        //
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

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Campaign::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}