<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $report = News::where('campaign_id',$request->id)->get();
        $campaign = Campaign::where('id',$request->id)->firstOrFail();
        $data = [
            'title' => 'News Report',
        ];
        return view('admin.news.news',compact('data','report','campaign'));
    }

    public function create(Request $request)
    {
        $campaign = Campaign::where('id',$request->id)->firstOrFail();
        $data = [
            'title' => 'Add News Report',
        ];
        return view('admin.news.create-news',compact('data','campaign'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'campaign_id' => 'required',
            'title' => 'required|max:255',
            'description' => 'required',
            'files' => 'image|file|max:1024',
        ]);
        
        if ($request->file('files')) {
            $validatedData['files'] = $request->file('files')->store('report-image');
        }
        $dateNow = \Carbon\Carbon::now()->timezone('Asia/Jakarta');
        $validatedData['created_at'] = $dateNow;
        $validatedData['updated_at'] = $dateNow;

        $store = News::create($validatedData);
        if ($store == true) {
            return redirect('admin/news?id='. $request->campaign_id)->with('success','Add news report is successful');
        }
        else{
            return redirect('admin/news?id='. $request->campaign_id)->with('error','Add news report is failed');
        }
    }

    public function show($id)
    {
        $campaign = Campaign::findOrFail($id)->first();
        $data = [
            'title' => 'News Report',
        ];
        return view('admin.news.show-news',compact('data','campaign'));
    }

    public function edit($id)
    {
        $report = News::where('id',$id)->firstOrFail();
        $data = [
            'title' => 'Edit News Report',
        ];
        return view('admin.news.edit-news',compact('data','report'));

    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'campaign_id' => 'required',
            'title' => 'required|max:255',
            'description' => 'required',
            'files' => 'image|file|max:1024',
        ]);
        if ($request->file('files')) {
            $validatedData['files'] = $request->file('files')->store('report-image');
        }

        $report = News::where('id',$id)->firstOrFail();

        $store = $report->update($validatedData);
        if ($store == true) {
            return redirect('admin/news?id='. $request->campaign_id)->with('success','Edit news report is successful');
        }
        else{
            return redirect('admin/news?id='. $request->campaign_id)->with('error','Edit news report is failed');
        }
    }


    public function destroy($id)
    {
        $report = News::where('id',$id)->firstOrFail();
        $delete = $report->delete();
        if ($delete == true) {
            return redirect()->back()->with('success','Delete news report is successful');
        }
        else{
            return redirect()->back()->with('error','Delete news report is failed');
        }
    }
}
