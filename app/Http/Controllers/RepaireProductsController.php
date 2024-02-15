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
        return view('pages.products.repaire-products');
    }


    public function store(Request $request)
    {

        $product = DB::table('products')->where('sku', $request->sku)->first();
        if (empty($product->sku)) {

            return redirect()->route('Products.repaire')->with('Errors', 'Product Not Found!');
        } else {
            $product = DB::table('repaire_products')->where('sku', $request->sku)->first();
            if ($product->id > 0) {
                return redirect()->route('Products.repaire')->with('Errors', 'Product Already Added!');
            } else {

                $repaire_product = new RepaireProduct;
                $repaire_product->sku = $request->sku;
                $repaire_product->save();

                Product::where('sku', $product->sku)->update(['sale_status' => 3]);
                return redirect()->back();
            }
        }
    }
}
