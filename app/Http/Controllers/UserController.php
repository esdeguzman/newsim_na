<?php

namespace App\Http\Controllers;

use Laravel\Passport\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Token;
use App\User;
use App\Department;
use App\Position;
use App\Branch;
use App\Role;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if($query = request('search')) {
            $users = User::where('first_name', 'LIKE', '%' . $query . '%')
                ->orWhere('last_name', 'LIKE', '%' . $query . '%')
                ->orWhere('department', 'LIKE', '%' . $query . '%')
                ->orWhere('type', 'LIKE', '%' . $query . '%')
                ->orWhere('position', 'LIKE', '%' . $query . '%')->paginate(12);

            return view('users.index', compact('users'));
        } else {
            $users = User::paginate(12);
            return view('users.index', compact('users'));
        }
    }

    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();
        $branches = Branch::all();
        $applications = Client::where('revoked', '!=', 1)->get();
        return view('users.create', compact('departments', 'positions', 'applications', 'branches'));
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'employee_id' => 'required|unique:users,employee_id',
            'email' => 'required|unique:users,email|email|max:191',
            'department' => 'required|max:191',
            'position' => 'required|max:191',
            'employment_status' => 'required|max:191',
            'account_type' => 'required',
            'username' => 'required|unique:users,username|max:191',
            'password' => 'required|max:191',
            'confirm_password' => 'required|same:password'
        ])->validate();

        $user = new User();
        $user->first_name = $request->first_name;
        $user->middle_name = is_null($request->middle_name) ? '' : $request->middle_name;
        $user->last_name = $request->last_name;
        $user->gender = $request->gender;
        $user->employee_id = $request->employee_id;
        $user->email = $request->email;
        $user->department = $request->department;
        $user->chief = is_null($request->chief) ? false : true;
        $user->position = $request->position;
        $user->branch = $request->branch;
        $user->employment_status = $request->employment_status;
        $user->remarks = is_null($request->remarks) ? '' : $request->remarks;
        $user->type = $request->account_type;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->save();

        $applications = Client::where('revoked', '!=', 1)->get();
        foreach ($applications as $application) {
            if ($request[$application->code]) {
                $role = new Role();
                $role->user_id = $user->id;
                $role->client_id = $application->id;
                $role->type = $request[$application->code . '_role'];
                $role->save();
            } else {
                $role = new Role();
                $role->user_id = $user->id;
                $role->client_id = $application->id;
                $role->save();
                $role->delete();
            }
        }

        session()->flash('notify', ['message' => 'User successfully created!', 'type' => 'success']);
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departments = Department::all();
        $positions = Position::all();
        $branches = Branch::all();
        $applications = Client::where('revoked', '!=', 1)->get();
        $user = User::find($id);
        return view('users.edit', compact('user', 'departments', 'positions', 'branches', 'applications'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'employee_id' => 'required|unique:users,employee_id,' . $id,
            'email' => 'required|email|max:191|unique:users,email,' . $id,
            'department' => 'required|max:191',
            'position' => 'required|max:191',
            'employment_status' => 'required|max:191',
            'account_type' => 'required',
            'username' => 'required|max:191|unique:users,username,' . $id,
        ])->validate();

        $user = User::with('roles')->find($id);
        $user->first_name = $request->first_name;
        $user->middle_name = is_null($request->middle_name) ? '' : $request->middle_name;
        $user->last_name = $request->last_name;
        $user->gender = $request->gender;
        $user->employee_id = $request->employee_id;
        $user->email = $request->email;
        $user->department = $request->department;
        $user->chief = is_null($request->chief) ? false : true;
        $user->position = $request->position;
        $user->branch = $request->branch;
        $user->employment_status = $request->employment_status;
        $user->remarks = is_null($request->remarks) ? '' : $request->remarks;
        $user->type = $request->account_type;
        $user->username = $request->username;
        $user->save();

        $applications = Client::where('revoked', '!=', 1)->get();
        foreach ($applications as $application) {
            if ($request[$application->code]) {
                $hasRole = false;
                foreach (Role::withTrashed()->where('user_id', $id)->get() as $role) {
                    if ($role->client_id == $application->id) {
                        $hasRole = true;
                        $role->type = $request[$application->code . '_role'];
                        $role->save();
                        $role->restore();
                    }
                }

                if ( ! $hasRole) {
                    $role = new Role();
                    $role->user_id = $user->id;
                    $role->client_id = $application->id;
                    $role->type = $request[$application->code . '_role'];
                    $role->save();
                }

            } else {
                $hasRole = false;
                foreach (Role::withTrashed()->where('user_id', $id)->get() as $role) {
                    if ($role->client_id == $application->id) {
                        $hasRole = true;
                        $role->type = $request[$application->code . '_role'];
                        $role->save();
                        $role->delete();
                    }
                }

                if ( ! $hasRole) {
                    $role = new Role();
                    $role->user_id = $user->id;
                    $role->client_id = $application->id;
                    $role->type = $request[$application->code . '_role'];
                    $role->save();
                    $role->delete();
                }

            }
        }

        session()->flash('notify', ['message' => $user->fullName() . ' has been updated!', 'type' => 'success']);
        return redirect()->route('users.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
       $this->deletable($user);

        if(session('notify')) {
            return redirect()->route('users.index');
        }

        $user->delete($user); //soft delete user

        session()->flash('notify', ['message' => $user->fullName() . '\' account has been deleted!', 'type' => 'success']);
        return redirect()->route('users.index');
    }

    public function logout($id) {
        $tokens = Token::where('user_id', Auth::user()->id)->update(['revoked' => true]);
        return view('auth.logout');
    }

    public function deletable($user) {
        $client = new \GuzzleHttp\Client();
        $res = $client->get("eqms.dev/eqms-user/$user->id");
        $super_admins = count(User::where('type', 'super-admin')->get());

        if($super_admins == 1 && $user->id == 2) {
            session()->flash('notify', ['message' => 'This account cannot be de-activated/deleted, this is a reserved SuperAdmin account.', 'type' => 'error']);
        } elseif($res->getBody() == 'admin') {
            session()->flash('notify', ['message' => 'This account is currently being used on eQMS as an administrator and cannot be de-activated/deleted.', 'type' => 'error']);
        }
    }

    public function changeStatus($id){
        $user = User::find($id);

        $this->deletable($user);

        if(session('notify')) {
            return redirect()->route('users.index');
        }

        if(request('change-to') == 'Activate') {
            $user->employment_status = 'active';
            $user->save();
        } else {
            $user->employment_status = 'inactive';
            $user->save();
        }

        session()->flash('notify', ['message' => $user->fullName() . ' has been updated!', 'type' => 'success']);
        return redirect()->route('users.index');
    }

    public function changePassword($id) {
        $user = User::find($id);
        return view('auth.passwords.reset', compact('user'));
    }

    public function processPasswordChange($id, Request $request) {
        $user = User::find($id);

        $this->validate($request, ['password' => 'required', 'password_confirmation' => 'required|same:password']);

        $user->password = bcrypt($request->password);
        $user->save();

        session()->flash('notify', ['message' => $user->fullName() . '\'s password has been updated!', 'type' => 'success']);
        return redirect()->route('users.edit', $user->id);
    }
}
