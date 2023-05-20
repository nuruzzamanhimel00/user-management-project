<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
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
        // dd($products);
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
    public function edit(Product $product)
    {
        set_page_meta('Product Edit');
        // dd($product);
        return view('backend.pages.products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();
            $this->productSerivce->createOrUpdate($data, $id);
            DB::commit();
            return redirect()->route('products.index')->with('success','Products Update Sucessfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('products.index')->with('error','Something is wrong!!');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if($this->productSerivce->productDelete($product)){
            return redirect()->route('products.index')->with('success','Product Delete Sucessfully');
        }
    }
}
