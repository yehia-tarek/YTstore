<?php

namespace App\Http\Controllers\Backend;


use App\Models\Shipping;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingRequest;
use App\Services\Shipping\IShippingService;

class ShippingController extends Controller
{
    protected $shippingService;


    public function __construct(IShippingService $shippingService)
    {
        $this->shippingService = $shippingService;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $shippings = $this->shippingService->getAllShippings(true, 10, 'id', 'DESC');

        return view('backend.shipping.index', [
            'shippings' => $shippings
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('backend.shipping.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShippingRequest $request)
    {
        $status = $this->shippingService->store($request->validated());

        if ($status) {
            request()->session()->flash('success', 'Shipping successfully created');
        } else {
            request()->session()->flash('error', 'Error, Please try again');
        }

        return redirect()->route('shipping.index');
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
        $shipping = $this->shippingService->getShippingById($id);

        if (!$shipping) {
            request()->session()->flash('error', 'Shipping not found');
        }

        return view('backend.shipping.edit', [
            'shipping' => $shipping
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShippingRequest $request, $id)
    {
        $status = $this->shippingService->update($request->validated(), $id);

        if ($status) {
            request()->session()->flash('success', 'Shipping successfully updated');
        } else {
            request()->session()->flash('error', 'No update done');
        }

        return redirect()->route('shipping.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = $this->shippingService->delete($id);

        if ($status) {
            request()->session()->flash('success', 'Shipping successfully deleted');
        } else {
            request()->session()->flash('error', 'Error, Please try again');
        }

        return redirect()->route('shipping.index');
    }
}
