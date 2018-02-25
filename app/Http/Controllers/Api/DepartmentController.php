<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Department;

class DepartmentController extends Controller
{
    public function index(Request $request) {
        return Department::all();
    }

    public function show($id, Request $request) {
        return Department::find($id);
    }
}
