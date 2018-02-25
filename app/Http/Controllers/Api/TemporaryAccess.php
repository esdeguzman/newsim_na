<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Role;
use App\User;
use Carbon\Carbon;

class TemporaryAccess extends Controller
{
    public function grant(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'client_id' => 'required|integer',
            'hour' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        $role = Role::withTrashed()->where('user_id', $request->user_id)->where('client_id', $request->client_id)->first();
        if ($role) {
            $carbon = Carbon::now();
            $role->expired_at = $carbon->addHours($request->hour);
            $role->save();
            $role->restore();
            return $role;
        } else {
            $carbon = Carbon::now();
            $role = new Role();
            $role->user_id = $request->user_id;
            $role->client_id = $request->client_id;
            $role->expired_at = $carbon->addHours($request->hour);
            $role->save();
            return $role;
        }
    }

    public function revoke(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'client_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        $role = Role::withTrashed()->where('user_id', $request->user_id)->where('client_id', $request->client_id)->first();
        if ($role) {
            $carbon = Carbon::now();
            $role->expired_at = null;
            $role->save();
            $role->delete();
            return $role;
        } else {
            $carbon = Carbon::now();
            $role = new Role();
            $role->user_id = $request->user_id;
            $role->client_id = $request->client_id;
            $role->save();
            $role->delete();
            return $role;
        }
    }
}
