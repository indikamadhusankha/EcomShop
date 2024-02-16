<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\RepaireProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepaireProductsController extends Controller
{
    public function index()
    {
        $products = DB::table('repaire_products')->select('repaire_products.*','categories.name as CatName','products.title as ProName')->leftJoin('products','products.sku','repaire_products.sku')->leftJoin('categories','categories.id','products.category_id')->get();

        return view('pages.products.repaire-products', compact('products'));

    }


    public function store(Request $request)
    {

        $product = DB::table('products')->where('sku', $request->sku)->first();
        if (empty($product->sku)) {

            return redirect()->route('Products.repaire')->with('Errors', 'Product Not Found!');
        } else {
            $Reproduct = DB::table('repaire_products')->where('sku', $request->sku)->first();
            if (!empty($Reproduct) && ($Reproduct->sku > 0)) {
                return redirect()->route('Products.repaire')->with('Errors', 'Product Already Added!');
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
}
