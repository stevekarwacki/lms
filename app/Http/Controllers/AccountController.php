<?php

namespace App\Http\Controllers;

use App\Http\ViewComposers\MenuComposer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class AccountController extends Controller
{

    protected $menuComposer;

    public function __construct()
    {
        $this->middleware('auth');
        $this->menuComposer = new MenuComposer();
        $layout = 'layouts/2column';
        View::share('layout', $layout);
    }

    public function index()
    {
        $user = Auth::user();
        $this->menuComposer->accountMenu($user);
        return view('account.index')->with(compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        $this->menuComposer->accountMenu($user);
        return view('account.edit')->with(compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $this->menuComposer->accountMenu($user);
        if(Hash::check($request->password, $user->password)) {
            $updatedUser = array();
            $updatedUser['id'] = $user->id;
            if($request->name != '') $updatedUser['name'] = $request->name;
            if($request->email != '') $updatedUser['email'] = $request->email;
            $user->update($updatedUser);
        }
        return view('account.edit')->with(compact('user'));
    }

}
