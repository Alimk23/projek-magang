<?php

namespace App\Http\Controllers\SuperAdmin;

use Inertia\Inertia;
use App\Models\Profile;
use App\Models\Campaign;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\CategoryByUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
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
    public function create(Profile $profile)
    {
        $user = Auth::user();
        $getProfileData = $profile->firstWhere('user_id', $user->id);
        if ($getProfileData) {
            $icons = $this->getIconData();
            $data = [
                'title' => 'Category',
                'user_id' => $user->id
            ];
            return view('superadmin.category.create-category',compact('data','icons'));
        } 
        else {
            return redirect('/superadmin/profile')->with('forbidden','Silahkan lengkapi data profil terlebih dahulu');
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
            'user_id' => 'required|max:255',
            'title' => 'required|max:255',
            'icon' => 'required|max:255',
        ]);
        $store = Category::create([
            'title' => $validatedData['title'],
            'icon' => $validatedData['icon'],
        ]);

        if ($store == true) {
            return redirect('/superadmin/category')->with('success','Add new category successful');
        }
        else{
            return redirect('/superadmin/category')->with('error','Add new category failed');
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
        $selectedCategory = Category::where('id',$id)->first();
        $getCampaign = Campaign::where('category_id',$id)->get();
        $getCategory = Category::all();
        $data = [
            'title' => $selectedCategory->title,
            'campaign' => $getCampaign,
            'category' => $getCategory,
        ];
        return Inertia::render('Category/Show',$data);
        // return view('user.show-by-category',compact('getCampaign','getCategory','selectedCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::where('id',$id)->first();
        $icons = $this->getIconData();
        $data=[
            'title'=>'Edit Category'
        ];
        return view('superadmin.category.edit-category', compact('data','category','icons'));
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
            'icon' => 'required|max:255',
        ]);
        $category = Category::where('id',$id)->first();
        $update = $category->update($validatedData);

        if ($update == true) {
            return redirect('/superadmin/category')->with('success','Edit category is successful');
        }
        else{
            return redirect('/superadmin/category')->with('error','Edit category is failed');
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
        $delete = Category::destroy($id);
        if ($delete) {
            return redirect('/superadmin/category')->with('success','Delete category is successful');
        }
        else{
            return redirect('/superadmin/category')->with('error','Delete category is failed');
        }
    }
    public function getIconData(){
        $content = file_get_contents('https://raw.githubusercontent.com/FortAwesome/Font-Awesome/master/metadata/icons.json');
        $json = json_decode($content);
        $icons = [];
    
        foreach ($json as $icon => $value) {
            foreach ($value->styles as $style) {
                $icons[] = 'fa-3x fa'.substr($style, 0 ,1).' fa-'.$icon;
            }
        }
        return $icons;
    }
}
