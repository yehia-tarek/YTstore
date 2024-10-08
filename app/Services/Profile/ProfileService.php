<?php

namespace App\Services\Profile;

use App\Repositories\Profile\IProfileRepository;

class ProfileService implements IProfileService
{
    private $profileRepository;

    public function __construct(IProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }
    public function update($request, $userId)
    {
        $data = [
            'name' => $request->name,
            'photo' => $request->photo
        ];

        return $this->profileRepository->update($data, $userId);
    }
}
