<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\View;

class MenuComposer
{

    /**
     * Return path of account menu
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return void
     */
    public function accountMenu($user)
    {
        switch ($user->type) {
            case 'parent':
                View::share('menu', 'menus/parent-account-menu');
                break;
            case 'mentor':
                View::share('menu', 'menus/mentor-account-menu');
                break;
            default:
                View::share('menu', false);
        }

    }

}