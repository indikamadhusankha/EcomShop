<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepaireProductsController extends Controller
{
    public function index(){
        return view('pages.products.repaire-products');
    }


    public function store(Request $request){
        $product = DB::table('products')->where('sku',$request->sku)->first();
        if($product->sku > 0){
            dd('indika');

        }else{
            dd('error');
        }

    }
}
