<?php

namespace App\Http\Controllers\Auth;

use App\Services\Auth\AuthService;
use App\Http\Controllers\Controller;

class AuthBaseController extends Controller
{
    public $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }
}
