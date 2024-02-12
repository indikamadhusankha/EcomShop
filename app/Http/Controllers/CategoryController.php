<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    protected $Category;

    public function __construct(){
        $this->Category = new Category;
    }

    public function index(Request $request)
    {
        $Category = Category::latest();
        if(!empty($request->get('keyword'))){
            $Category = DB::table('categories')->where('name','LIKE', '%' .$request->get('keyword'). '%');

        }
        $Category = $Category->paginate(10);
        return view('pages.categories.index',compact('Category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.categories.new-categories');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:categories,slug'
        ]);

        if($Validator->passes()){

           $this->Category->create($request->all());
           return redirect()->route('Categories.index')->with('Success', 'Categories Added Success!');

        }else{
            return redirect()->route('Categories.create')->withErrors($Validator)->withInput();

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $catData = $this->Category->find($id);
        return view('pages.categories.edit-categories',compact('catData'));
    }

    public function update(Request $request, string $id)
    {

        $Category = $this->Category->find($id);
        $Validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,' .$Category->id. ',id'
        ]);

        if($Validator->passes()){

           $Category->update(array_merge($Category->toArray(), $request->all()));

           return redirect()->route('Categories.index')->with('Success', 'Categories Update Success!');

        }else{
            return redirect()->back()->withErrors($Validator)->withInput();

        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Category = $this->Category->destroy($id);
        return redirect()->route('Categories.index')->with('Success', 'Category Deleted success!');
    }
}
