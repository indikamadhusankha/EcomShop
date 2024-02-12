<?php

use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RepaireProductsController;
use App\Http\Controllers\ProductSubCategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Models\RepaireProduct;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::class,'index'])->name('Home.dashboard');


//Suppliers Routes
Route::group(['prefix' => 'Suppliers'], function () {
    Route::get('/', [SuppliersController::class, 'index'])->name('Suppliers.index');
    Route::get('/NewSupplier', [SuppliersController::class, 'create'])->name('Suppliers.create');
    Route::post('/CreateSupplier', [SuppliersController::class, 'store'])->name('Suppliers.store');
    Route::get('/ViewSupplier/{id}', [SuppliersController::class, 'show'])->name('Suppliers.show');
    Route::post('/UpdateSupplier/{id}', [SuppliersController::class, 'update'])->name('Suppliers.update');
    Route::get('/DeleteSupplier/{id}', [SuppliersController::class, 'destroy'])->name('Suppliers.delete');
});

//Categories Routes

Route::group(['prefix' => 'Categories'], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('Categories.index');
    Route::get('/NewCategory', [CategoryController::class, 'create'])->name('Categories.create');
    Route::post('/CreateCategory', [CategoryController::class, 'store'])->name('Categories.store');
    Route::get('/ViewCategory/{id}', [CategoryController::class, 'show'])->name('Categories.show');
    Route::post('/UpdateCategory/{id}', [CategoryController::class, 'update'])->name('Categories.update');
    Route::get('/DeleteCategory/{id}', [CategoryController::class, 'destroy'])->name('Categories.delete');
});


// Sub Categories Routes

Route::group(['prefix' => 'Sub-Categories'], function () {
    Route::get('/', [SubCategoryController::class, 'index'])->name('Sub-Categories.index');
    Route::get('/NewSubCategory', [SubCategoryController::class, 'create'])->name('Sub-Categories.create');
    Route::post('/CreateSubCategory', [SubCategoryController::class, 'store'])->name('Sub-Categories.store');
    Route::get('/ViewSubCategory/{id}', [SubCategoryController::class, 'show'])->name('Sub-Categories.show');
    Route::post('/UpdateSubCategory/{id}', [SubCategoryController::class, 'update'])->name('Sub-Categories.update');
    Route::get('/DeleteSubCategory/{id}', [SubCategoryController::class, 'destroy'])->name('Sub-Categories.delete');

});


// Products Routes

Route::group(['prefix' => 'Products'], function () {
    Route::get('/', [ProductController::class, 'index'])->name('Products.index');
    Route::get('/NewProduct', [ProductController::class, 'create'])->name('Products.create');
    Route::post('/CreateProduct', [ProductController::class, 'store'])->name('Products.store');
    Route::get('/ViewProduct/{id}', [ProductController::class, 'show'])->name('Products.show');
    Route::post('/UpdateProduct/{id}', [ProductController::class, 'update'])->name('Products.update');
    Route::get('/DeleteProduct/{id}', [ProductController::class, 'destroy'])->name('Products.delete');

    //Repaire Products

    Route::get('/RepaireProducts', [ProductController::class, 'index'])->name('Products.delete');

    // Products Sub Category Route

        Route::get('/GetSubCategory', [RepaireProductsController::class, 'index'])->name('Products.repaire');

});


//get slug
Route::get('/slug', function (Request $request) {
    $slug ='';
    if (!empty($request->name)) {
        $slug = Str::slug($request->name);
    }

    return response()->json([
        'status' => true,
        'slug' => $slug
    ]);
})->name('Categories.slug');
