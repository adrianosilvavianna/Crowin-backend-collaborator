<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    protected $packege;

    public function __construct(Package $package)
    {
        $this->packege = $package;
    }

    public function index()
    {
        return response()->json($this->packege->all());
    }
}
