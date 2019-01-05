<?php

namespace App\Http\Controllers;

use App\Http\ViewComposers\MenuComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
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
        return view('search.index')->with(compact('user'));
    }
}
