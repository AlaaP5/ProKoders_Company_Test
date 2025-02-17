<?php

namespace App\Modules\CommonModule\Auth\Services;
use App\Modules\CommonModule\ResponseModels\ApiResponse;

interface AuthServiceInterface {
    function login(string $email, string $password):ApiResponse;
    function logout():ApiResponse;
}
