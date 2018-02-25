<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Branch;

class BranchController extends Controller
{
    public function index(Request $request) {
        return Branch::all();
    }

    public function show($id, Request $request) {
        return Branch::find($id);
    }
}
