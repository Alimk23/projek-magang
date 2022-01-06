<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoryByUser;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
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
    public function index(Category $category, CategoryByUser $categoryByUser)
    {
        $user = Auth::user();
        $getCategory = $categoryByUser->where('user_id',$user->id)->get();
        $data = [
            'title' => 'Category'
        ];
        return view('admin.category',compact('data', 'getCategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $content = file_get_contents('https://raw.githubusercontent.com/FortAwesome/Font-Awesome/master/metadata/icons.json');
        $json = json_decode($content);
        $icons = [];
    
        foreach ($json as $icon => $value) {
            foreach ($value->styles as $style) {
                $icons[] = 'fa-3x fa'.substr($style, 0 ,1).' fa-'.$icon;
            }
        }
        $user = Auth::user();
        $data = [
            'title' => 'Category',
            'user_id' => $user->id
        ];
        return view('admin.create-category',compact('data','icons'));
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
            return redirect('/category')->with('success','Add new category successful');
        }
        else{
            return redirect('/category')->with('error','Add new category failed');
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
        //
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
}
