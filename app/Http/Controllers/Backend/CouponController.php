<?php

namespace App\Http\Controllers\Backend;

use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Services\Coupon\ICouponService;

class CouponController extends Controller
{

    protected $couponService;

    public function __construct(ICouponService $couponService)
    {
        $this->couponService = $couponService;
    }
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $coupons = $this->couponService->getAllCoupons(true, 10, 'id', 'DESC');

        return view('backend.coupon.index', [
            'coupons' => $coupons
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('backend.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponRequest $request)
    {
        $status = $this->couponService->store($request->validated());

        if ($status) {
            request()->session()->flash('success', 'Coupon Successfully added');
        } else {
            request()->session()->flash('error', 'Please try again!!');
        }

        return redirect()->route('coupon.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $coupon =  $this->couponService->getCouponById($id);

        if (!$coupon) {
            return redirect()->route('coupon.index')->with('error', 'Coupon not found');
        }

        return view('backend.coupon.edit', [
            'coupon' => $coupon
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CouponRequest $request, $id)
    {

        $status = $this->couponService->update($request->validated(), $id);

        if ($status) {
            request()->session()->flash('success', 'Coupon Successfully updated');
        } else {
            request()->session()->flash('error', 'No update done');
        }

        return redirect()->route('coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = $this->couponService->delete($id);

        if ($status) {
            request()->session()->flash('success', 'Coupon successfully deleted');
        } else {
            request()->session()->flash('error', 'Error, Please try again');
        }

        return redirect()->route('coupon.index');
    }

    public function couponStore(Request $request)
    {
        $coupon = $this->couponService->getCouponByCode($request->code);

        if (!$coupon) {
            request()->session()->flash('error', 'Invalid coupon code, Please try again');
            return back();
        }

        $total_price = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->sum('price');

        session()->put('coupon', [
            'id' => $coupon->id,
            'code' => $coupon->code,
            'value' => $coupon->discount($total_price)
        ]);

        request()->session()->flash('success', 'Coupon successfully applied');

        return redirect()->back();
    }
}
