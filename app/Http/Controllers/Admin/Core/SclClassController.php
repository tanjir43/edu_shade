<?php

namespace App\Http\Controllers\Admin\Core;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\SclClassRepositoryInterface;

class SclClassController extends Controller
{
    protected $labelRepository;

    public function __construct(SclClassRepositoryInterface $labelRepository)
    {
        $this->labelRepository = $labelRepository;
    }
}
