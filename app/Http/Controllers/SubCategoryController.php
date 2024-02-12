<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class SubCategoryController extends Controller
{
    protected $subCat;

    public function __construct(){
        $this->subCat = new SubCategory;
    }


    public function index(Request $request)
    {

        $SubCategory = SubCategory::select('sub_categories.*', 'categories.name as category_name')->latest('id')->leftJoin('categories', 'categories.id','=','sub_categories.category_id');
        if(!empty($request->get('keyword'))){
            $SubCategory = DB::table('sub_categories')->where('name','LIKE', '%' .$request->get('keyword'). '%');

        }
        $SubCategory = $SubCategory->paginate(10);
        return view('pages.sub-categories.index',compact('SubCategory'));

    }


    public function create()
    {
        $Categories = Category::Where('status',1)->orderBy('name', 'ASC')->get();
        return view('pages.sub-categories.new-sub-categories', compact('Categories'));
    }

    public function store(Request $request)
    {
        $Validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug'=>'required|unique:sub_categories',
            'category_id' => 'required',
        ]);

        if ($Validator->passes()) {
            $this->subCat->create($request->all());
            return redirect()->route('Sub-Categories.index')->with('Success', 'Sub Categories Added Success!');
        }else{
            return redirect()->route('Sub-Categories.create')->withErrors($Validator)->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data ['Categories'] = Category::orderBy('name', 'ASC')->get();
        $data ['SubCategories'] = $this->subCat->find($id);

        return view('pages.sub-categories.edit-sub-categories', $data);
    }

    public function update(Request $request, string $id)
    {
        $subCat =  $this->subCat->find($id);

        $Validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug'=>'required|unique:sub_categories,slug,'.$request->id.',id',
            'category_id' => 'required',
        ]);

        if ($Validator->passes()) {

            $subCat->update(array_merge($subCat->toArray(), $request->all() ));

            return redirect()->route('Sub-Categories.index')->with('Success', 'Sub Categories Update Success!');
        }else{
            return redirect()->back()->withErrors($Validator)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->subCat->destroy($id);
        return redirect()->route('Sub-Categories.index')->with('Success', 'Sub Category Deleted Success!');
    }
}
