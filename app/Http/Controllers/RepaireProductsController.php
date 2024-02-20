<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\RepaireProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepaireProductsController extends Controller
{

    protected $rep_product;

    public function __construct(){
        $this->rep_product = new RepaireProduct;
    }


    public function index(Request $request)
    {
        $products = DB::table('repaire_products')->select('repaire_products.*','categories.name as CatName','products.title as ProName','repaire_status.rep_status')->leftJoin('products','products.sku','repaire_products.sku')->leftJoin('categories','categories.id','products.category_id')
        ->leftJoin('repaire_status','repaire_status.id','repaire_products.ReStatus')
        ->latest();

        if (!empty($request->get('keyword'))) {

            $products = DB::table('repaire_products')->select('repaire_products.*','categories.name as CatName','products.title as ProName','repaire_status.rep_status')->leftJoin('products','products.sku','repaire_products.sku')->leftJoin('categories','categories.id','products.category_id')
            ->leftJoin('repaire_status','repaire_status.id','repaire_products.ReStatus')
            ->where('repaire_products.sku', 'LIKE', '%' . $request->get('keyword') . '%');
        }

        $products = $products->paginate(10);

        return view('pages.products.repaire-products', compact('products'));

    }


    public function store(Request $request)
    {

        $product = DB::table('products')->where('sku', $request->sku)->first();
        if (empty($product->sku)) {

            return redirect()->route('Products.repaire')->with('Errors', 'Product Not Found!');
        } else {
            $Reproduct = DB::table('repaire_products')->where('sku', $request->sku)->where('ReStatus','1')->first();
            if (!empty($Reproduct) && ($Reproduct->sku > 0)) {
                return redirect()->route('Products.repaire')->with('Errors', 'This product is already under repair!');
            } else {

                $repaire_product = new RepaireProduct;
                $repaire_product->sku = $request->sku;
                $repaire_product->Product_id = $product->id;
                $repaire_product->save();

                Product::where('sku', $request->sku)->update(['sale_status' => 3]);
                return redirect()->back();
            }
        }
    }

    public function show($id){
       $data['Rep_Product'] = $this->rep_product->find($id);
       $product_id = $data['Rep_Product']->Product_id;
       $data['Suppliers'] = Supplier::orderBy('name', 'ASC')->get();
       $data['Product'] = Product::where('id',$product_id)->first();

      /*  dd($data['Product']); */


       return view('pages.products.showRepaire', $data);
    }

    public function update(Request $request, $id){

        $product = $this->rep_product->find($id);
        $product->update(array_merge($product->toArray(),$request->all()));
        Product::where('id', $product->Product_id)->update(['sale_status' => 1]);
        RepaireProduct::where('id', $id)->update(['ReStatus'=> $request->ReStatus]);
        return redirect()->route('Products.repaire')->with('Success', 'Product Repaire Complete!');
    }
}
