<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;
use App\Services\Common\ProductSerivce;

class ProductController extends Controller
{
    public $productSerivce;
    public function __construct(ProductSerivce $productSerivce)
    {
        $this->productSerivce = $productSerivce;

        // $this->middleware(['permission:User List'])->only(['index']);
        // $this->middleware(['permission:User Add'])->only(['create']);
        // $this->middleware(['permission:User Store'])->only(['store']);
        // $this->middleware(['permission:User Edit'])->only(['edit']);
        // $this->middleware(['permission:User Update'])->only(['update']);
        // $this->middleware(['permission:User Delete'])->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        set_page_meta('User List');
        $products = $this->productSerivce->getLatestProducts();
        return view('backend.pages.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        set_page_meta('Create Product');
        return view('backend.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();
            $this->productSerivce->createOrUpdate($data);
            DB::commit();
            return redirect()->route('products.index')->with('success','Products Created Sucessfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('products.index')->with('error','Something is wrong!!');
            // dd($e->getMessage());
            //throw $th;
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
