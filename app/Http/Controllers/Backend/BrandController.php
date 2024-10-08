<?php

namespace App\Http\Controllers\Backend;


use App\Http\Requests\BrandRequest;
use App\Http\Controllers\Controller;
use App\Services\Brand\IBrandService;

class BrandController extends Controller
{

    protected $brandService;

    public function __construct(IBrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $brands = $this->brandService->getAllBrands(true, 10, 'id', 'DESC');

        return view('backend.brand.index', [
            'brands' => $brands
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('backend.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        $status = $this->brandService->store($request->validated());

        if ($status) {
            request()->session()->flash('success', 'Brand successfully created');
        }else{
            request()->session()->flash('error', 'Error, Please try again');
        }

        return redirect()->route('brand.index');
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
        $brand = $this->brandService->getBrandById($id);

        if (!$brand) {
            request()->session()->flash('error', 'Brand not found');
        }

        return view('backend.brand.edit', [
            'brand' => $brand
        ]);
    }

    public function update(BrandRequest $request, $id)
    {
        $status = $this->brandService->update($request->validated(), $id);

        if ($status) {
            request()->session()->flash('success', 'Brand successfully updated');
        } else {
            request()->session()->flash('error', 'Error, Please try again');
        }

        return redirect()->route('brand.index');
    }

    public function destroy($id)
    {
        $status = $this->brandService->destroy($id);

        if ($status) {
            request()->session()->flash('success', 'Brand successfully deleted');
        } else {
            request()->session()->flash('error', 'Error, Please try again');
        }

        return redirect()->route('brand.index');
    }
}
