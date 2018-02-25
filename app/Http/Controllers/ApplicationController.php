<?php

namespace App\Http\Controllers;

use Laravel\Passport\Client;
use Laravel\Passport\Token;
use Illuminate\Http\Request;
use Laravel\Passport\ClientRepository;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;

class ApplicationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tokens = Token::where('revoked' , '!=', 1)->get();
        $applications = Client::where('revoked', '!=', 1)->get();
        return view('applications.index', compact('tokens', 'applications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('applications.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'code' => 'required',
            'name' => 'required|max:255',
            'description' => 'required',
            'redirect' => 'required|url',
        ])->validate();

        $application = (new Client)->forceFill([
            'user_id' => Auth::user()->getKey(),
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'secret' => str_random(40),
            'redirect' => $request->redirect,
            'personal_access_client' => false,
            'password_client' => false,
            'revoked' => false,
        ]);

        $application->save();
        session()->flash('notify', ['message' => $request->name . ' has been created!', 'type' => 'success']);
        return redirect()->route('applications.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $application = Client::find($id);
        $user = User::find($application->user_id);
        return view('applications.show', compact('application', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $application = Client::find($id);
        return view('applications.edit', compact('application'));
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
            'code' => 'required',
            'name' => 'required|max:255',
            'description' => 'required',
            'redirect' => 'required|url',
        ])->validate();

        $application = Client::find($id);
        $application->code = $request->code;
        $application->name = $request->name;
        $application->description = $request->description;
        $application->redirect = $request->redirect;
        $application->save();
        session()->flash('notify', ['message' => $application->name . ' has been updated!', 'type' => 'success']);
        return redirect()->route('applications.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($token_id = request('token_id')) {
            $token = Token::find($token_id);
            $token->revoked = true;
            $token->save();
            session()->flash('notify', ['message' => 'Access Token has been revoked', 'type' => 'success']);
            return redirect()->route('applications.index');
        } else {
            $application = Client::find($id);
            $application->revoked = 1;
            $application->save();
            session()->flash('notify', ['message' => $application->name . ' has been removed!', 'type' => 'success']);
            return redirect('eqms.newsimapps.dev');
        }
    }
}
