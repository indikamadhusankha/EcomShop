<?php

namespace App\Http\Controllers;

use App\Models\RepaireProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepaireProductsController extends Controller
{
    public function index(){
        return view('pages.products.repaire-products');
    }


    public function store(Request $request){
        $product = DB::table('products')->where('sku',$request->sku)->first();
        if(empty($product->sku)){


        }else{
            $repaire_product = new RepaireProduct;
            $repaire_product->sku = $request->sku;
            $repaire_product->save();
        }

    }
}
