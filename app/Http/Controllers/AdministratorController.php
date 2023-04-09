<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    public function index(){
        return view("administrator.index");
    }

    public function user_manager(){
        return view("administrator.user_manager");
    }
}
