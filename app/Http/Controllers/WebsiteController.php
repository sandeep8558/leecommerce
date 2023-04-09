<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{

    public function welcome(){
        if(User::where('email', 'sandeep198558@yahoo.com')->doesntExist()){
            $this->bootstrap();
        }
        return view("website.welcome");
    }

    public function bootstrap(){
        $user = User::create([
            "name" => "Sandeep Rathod",
            "mobile" => "9664588677",
            "email" => "sandeep198558@yahoo.com",
            "password" => Hash::make("123456789"),
        ]);

        Role::insert([
            [
                "user_id" => $user->id,
                "role" => "Customer",
                "Status" => "Active"
            ],
            [
                "user_id" => $user->id,
                "role" => "Administrator",
                "Status" => "Active"
            ],
            [
                "user_id" => $user->id,
                "role" => "Web-Admin",
                "Status" => "Active"
            ],
            [
                "user_id" => $user->id,
                "role" => "Store Manager",
                "Status" => "Active"
            ],
        ]);
    }

}