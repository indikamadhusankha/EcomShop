<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SuppliersController extends Controller
{

     protected $sup;

public function __construct()
    {
        $this->sup = new Supplier;
    }

    public function index(Request $request)
    {

        $suppliers = Supplier::latest();

        if(!empty($request->get('keyword'))){
            $suppliers = DB::table('suppliers')->where('name','LIKE', '%' .$request->get('keyword'). '%');

        }

       $suppliers = $suppliers->paginate(10);
       /* dd($data); */
        return view('pages.suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.suppliers.new-supplier');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:suppliers,email',

        ]);

        if($validator->passes()){
            $this->sup->create($request->all());
            return redirect()->route('Suppliers.index')->with('Success', 'Supplier Added Success!');
        }
else{
        return redirect()->route('Suppliers.create')->withErrors($validator)->withInput();
}

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Supplier = $this->sup->find($id);
       /*  dd($Suppliers); */

        return view ('pages.suppliers.edit-supplier', compact('Supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sup = $this->sup->find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:suppliers,email,' .$sup->id. ',id',
        ]);
        if($validator->passes()){
            $sup->update(array_merge($sup->toArray(), $request->all()));
            return redirect()->route('Suppliers.index')->with('Success', 'Supplier update success!');

        }
else{

        return redirect()->back()->withErrors($validator)->withInput();
}

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sup = $this->sup->destroy($id);
        return redirect()->route('Suppliers.index')->with('Success', 'Supplier Deleted success!');
    }



}
