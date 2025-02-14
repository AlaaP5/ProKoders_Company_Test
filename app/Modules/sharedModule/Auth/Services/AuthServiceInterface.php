<?php

namespace App\Modules\SharedModule\Auth\Services;
use App\Modules\SharedModule\ResponseModels\ApiResponse;

interface AuthServiceInterface {
    function login(string $email, string $password):ApiResponse;
    function logout():ApiResponse;
}
