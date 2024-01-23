<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(
        UserRepository $userRepository,
    ) {
        $this->userRepository = $userRepository;
    }

    public function getData()
    {
        return $this->userRepository->getData();
    }
}