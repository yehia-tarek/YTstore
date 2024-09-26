<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Profile\IProfileService;
use App\Http\Requests\Fronted\Dashboard\ProfileRequest;

class ProfileController extends Controller
{
    private $profileService;

    public function __construct(IProfileService $profileService)
    {
        $this->profileService = $profileService;
    }
    public function profile()
    {
        return view('backend.users.profile', [
            'profile' => auth()->user()
        ]);
    }

    public function profileUpdate(ProfileRequest $request, $id)
    {
        $updatedProfile = $this->profileService->update($request, $id);

        if ($updatedProfile) {
            request()->session()->flash('success', 'Successfully updated your profile');
        } else {
            request()->session()->flash('error', 'No Updated Has Been Made');
        }

        return redirect()->back();
    }
}
