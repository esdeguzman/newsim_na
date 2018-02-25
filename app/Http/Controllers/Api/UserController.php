<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Carbon\Carbon;

class UserController extends Controller
{

    public function user(Request $request) {
        if ($request->user()->employment_status == 'inactive') {
            return response(['error' => 'Inactive Account', 'user' => $request->user()], 403);
        }

        $role = Role::where('user_id', $request->user()->id)->where('client_id', $request->client_id)->first();
        if ( ! $role) {
            return response(['error' => 'Unauthorized Access', 'user' => $request->user()], 403);
        }

        if ($role->expired_at) {
            $currentDateTime = Carbon::now();
            $expirationDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $role->expired_at);
            if ($expirationDateTime->lte($currentDateTime)) {
                $role->expired_at = null;
                $role->save();
                $role->delete();
                return response(['error' => 'Expired Authorization'], 403);
            }
        }

        $user = User::find($request->user()->id);
        $user['role'] = $role->type;
        return $user;
    }

    public function index(Request $request) {
        $users = User::initialize();

        if ($branch = $request->branch) {
            $users->branch($branch);
        }

        if ($department = $request->department) {
            $users->department($department);
        }

        if ($position = $request->position) {
            $users->position($position);
        }

        if ($chief = $request->chief) {
            $users->chief($chief);
        }

        $users = $users->get();

        return $users;
    }

    public function show($id) {
        return User::find($id);
    }

    public function update(Request $request, $id) {
        $role = Role::where('user_id', $id)->where('client_id', $request->client_id)->first();
        if ($role) {
            $carbon = Carbon::now();
            $role->expired_at = $carbon->addHours(12);
            $role->save();
            return $role;
        }
    }

}
