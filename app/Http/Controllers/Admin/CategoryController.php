<?php

namespace App\Http\Controllers\Admin;

use App\Models\Profile;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\CategoryByUser;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category, CategoryByUser $categoryByUser)
    {
        $user = Auth::user();
        $getCategory = $categoryByUser->where('user_id',$user->id)->get();
        $data = [
            'title' => 'Category'
        ];
        return view('admin.category.category',compact('data', 'getCategory'));
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
            return view('admin.category.create-category',compact('data','icons'));
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
    public function store(Request $request, Category $category, CategoryByUser $categoryByUser)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|max:255',
            'title' => 'required|max:255',
            'icon' => 'required|max:255',
        ]);
        $store = Category::create([
            'title' => $validatedData['title'],
            'icon' => $validatedData['icon'],
        ])->id;
        $save = CategoryByUser::create([
            'user_id' => $validatedData['user_id'],
            'category_id' => $store,
        ]);

        if ($save == true) {
            return redirect('/admin/category')->with('success','Add new category successful');
        }
        else{
            return redirect('/admin/category')->with('error','Add new category failed');
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
        return view('user.show-by-category',compact('getCampaign','getCategory','selectedCategory'));
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
        return view('admin.category.edit-category', compact('data','category','icons'));
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
            return redirect('/admin/category')->with('success','Edit category is successful');
        }
        else{
            return redirect('/admin/category')->with('error','Edit category is failed');
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
        $CategoryByUser = CategoryByUser::firstWhere('category_id',$id);
        $del = $CategoryByUser->delete();
        $delete = Category::destroy($id);
        if ($delete) {
            return redirect('/admin/category')->with('success','Delete category is successful');
        }
        else{
            return redirect('/admin/category')->with('error','Delete category is failed');
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
