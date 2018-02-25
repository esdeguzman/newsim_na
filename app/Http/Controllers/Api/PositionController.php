<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Position;

class PositionController extends Controller
{
    public function index(Request $request) {
        return Position::all();
    }

    public function show($id, Request $request) {
        return Position::find($id);
    }
}
