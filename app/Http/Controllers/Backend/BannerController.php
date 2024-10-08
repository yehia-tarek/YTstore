<?php

namespace App\Http\Controllers\Backend;


use App\Models\Banner;
use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Services\Banner\IBannerService;

class BannerController extends Controller
{
    protected $bannerService;

    public function __construct(IBannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }

    public function index()
    {
        $banners = $this->bannerService->getAllBanners( true, 10, 'id', 'DESC' );

        return view('backend.banner.index', [
            'banners' => $banners
        ]);
    }


    public function create()
    {
        return view('backend.banner.create');
    }


    public function store(BannerRequest $request)
    {
        $status = $this->bannerService->store($request->validated());

        if ($status) {
            request()->session()->flash('success', 'Banner successfully added');
        } else {
            request()->session()->flash('error', 'Error occurred while adding banner');
        }

        return redirect()->route('banner.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('banner.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $banner = $this->bannerService->getBannerById($id);

        if (!$banner) {
            request()->session()->flash('error', 'Banner not found');
            return redirect()->route('banner.index');
        }

        return view('backend.banner.edit', [
            'banner' => $banner
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BannerRequest $request, $id)
    {
        $status = $this->bannerService->update($request->validated(), $id);

        if ($status) {
            request()->session()->flash('success', 'Banner successfully updated');
        } else {
            request()->session()->flash('error', 'No changes made');
        }

        return redirect()->route('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = $this->bannerService->destroy($id);

        if ($status) {
            request()->session()->flash('success', 'Banner successfully deleted');
        } else {
            request()->session()->flash('error', 'Error occurred while deleting banner');
        }

        return redirect()->route('banner.index');
    }
}
