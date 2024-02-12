<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Supplier;
use App\Models\SubCategory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $Product;

    public function __construct()
    {
        $this->Product = new Product;
    }

    public function index(Request $request)
    {
        $Products = Product::select('products.*','categories.name AS category_name','sub_categories.name as sub_category_name', 'suppliers.name as supplierName','sale_status.sale_status' )->leftJoin('categories','categories.id','products.category_id')->leftJoin('sub_categories','sub_categories.id','products.sub_category_id')
        ->leftJoin('suppliers','suppliers.id','products.supplier')->leftJoin('sale_status','sale_status.id','products.sale_status')
        ->latest();

        if(!empty($request->get('keyword'))){
            /* $Products = DB::table('products')->where('sku','LIKE', '%' .$request->get('keyword'). '%'); */
            $Products = Product::select('products.*','categories.name AS category_name','sub_categories.name as sub_category_name','sale_status.sale_status' )->leftJoin('categories','categories.id','products.category_id')->leftJoin('sub_categories','sub_categories.id','products.sub_category_id')->leftJoin('sale_status','sale_status.id','products.sale_status')
            ->where('sku','LIKE', '%' .$request->get('keyword'). '%');


        }

       $Products = $Products->paginate(10);


        return view('pages.products.index', compact('Products'));
    }


    public function create()
    {
        $data['Categories'] = Category::orderBy('name', 'ASC')->get();
        $data['Suppliers'] = Supplier::orderBy('name', 'ASC')->get();
        return view('pages.products.new-products', $data);

    }


    public function store(Request $request)
    {

        $Rules = [
            'title' => 'required',
            'slug'  => 'required',
            'supplier'  => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric',
            'sku'   => 'required|unique:products',

        ];

        $Validator = Validator::make($request->all(), $Rules);

        if ($Validator->passes()) {
            $this->Product->create($request->all());
            return response()->json([
                'status' => true,
                'Message' => "Product Added Success!"
            ]);
        } else {

            return response()->json([
                'status' => false,
                'errors' => $Validator->errors()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data ['Product'] = $this->Product->find($id);
        $data['Categories'] = Category::orderBy('name', 'ASC')->get();
        $data['Suppliers'] = Supplier::orderBy('name', 'ASC')->get();
        $data['Sub_Categories'] = SubCategory::where('category_id', $data ['Product']->category_id)->get();

        return view('pages.products.edit-products', $data);
    }


    public function update(Request $request, string $id)
    {
        $Rules = [
            'title' => 'required',
            'slug'  => 'required|unique:products,slug,' .$request->id. ',id',
            'supplier'  => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric',
            'sku'   => 'required|unique:products,sku,'.$request->id.',id',

        ];

        $Validator = Validator::make($request->all(), $Rules);

        if ($Validator->passes()) {

            $Product = $this->Product->find($id);
            $Product->update(array_merge($Product->toArray(), $request->all()));

            return response()->json([
                'status' => true,
                'Message' => "Product Edited Success!"
            ]);
        } else {

            return response()->json([
                'status' => false,
                'errors' => $Validator->errors()
            ]);
        }
    }

    public function destroy(string $id)
    {
        $this->Product->destroy($id);
        return redirect()->route('Products.index')->with('Success', 'Product Deleted Success!');
    }
}
