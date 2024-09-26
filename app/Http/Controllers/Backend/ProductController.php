<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Services\Brand\IBrandService;
use App\Services\Product\IProductService;
use App\Services\Caregory\ICategoryService;

class ProductController extends Controller
{
    protected $productService;
    protected $brandService;
    protected $categoryService;

    public function __construct(
        IProductService $productService,
        IBrandService $brandService,
        ICategoryService $categoryService
    ) {
        $this->productService = $productService;
        $this->brandService = $brandService;
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $products = $this->productService->getAllProduct();

        return view('backend.product.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $brands = $this->brandService->getAllBrands();
        $categories = $this->categoryService->getParentCategories(null, 'title', 'ASC');

        return view('backend.product.create', [
            'categories' => $categories,
            'brands' => $brands
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $status = $this->productService->store($request->validated());

        if ($status) {
            request()->session()->flash('success', 'Product Successfully added');
        } else {
            request()->session()->flash('error', 'Please try again!!');
        }
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $brands = $this->brandService->getAllBrands();
        $categories = $this->categoryService->getParentCategories(null, 'title', 'ASC');
        $product = $this->productService->getProductById($id);

        return view('backend.product.edit', [
            'product' => $product,
            'brands' => $brands,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $status = $this->productService->update($request->validated(), $id);

        if ($status) {
            request()->session()->flash('success', 'Product Successfully updated');
        } else {
            request()->session()->flash('error', 'No Update Done');
        }

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = $this->productService->delete($id);

        if ($status) {
            request()->session()->flash('success', 'Product successfully deleted');
        } else {
            request()->session()->flash('error', 'Error while deleting product');
        }

        return redirect()->route('product.index');
    }
}
