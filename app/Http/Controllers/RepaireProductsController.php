<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RepaireProductsController extends Controller
{
    public function index(){
        return view('pages.products.repaire-products');
    }
}
