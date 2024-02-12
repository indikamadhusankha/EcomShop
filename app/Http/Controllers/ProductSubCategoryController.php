<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductSubCategoryController extends Controller
{
    public function index(Request $request)
    {

        if (!empty($request->Category_id)) {

            $subCategories = SubCategory::where('category_id',$request->Category_id)->orderBy('name', 'ASC')->get();

            return response()->json([
                'status' => true,
                'subCategories' => $subCategories
            ]);


        } else {
            return response()->json([
                'status' => true,
                'subCategories' => []
            ]);
        }
    }
}
