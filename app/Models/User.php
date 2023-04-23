<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class User extends Authenticatable
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'mobile',
        'email',
        'password',
        'api_token',
        'token_expire_at',
        'otp',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function isAdministrator(){
        $is = $this->roles()
        ->where(function($q){
            $q
            ->orWhere('role', 'Administrator');
        })
        ->where('status', 'Active')->exists();
        if($is){
            return true;
        }
        return false;
    }

    public function isWebAdmin(){
        $is = $this->roles()
        ->where(function($q){
            $q
            ->orWhere('role', 'Web-Admin');
        })
        ->where('status', 'Active')->exists();
        if($this->roles()->where('role', 'Web-Admin')->where('status', 'Active')->exists()){
            return true;
        }
        return false;
    }

    public function isStoreManager(){
        $is = $this->roles()
        ->where(function($q){
            $q
            ->orWhere('role', 'Store Manager');
        })
        ->where('status', 'Active')->exists();

        if($is){
            return true;
        }
        return false;
    }

    public function isCustomer(){
        
        $is = $this->roles()
        ->where(function($q){
            $q
            ->where('role', 'Customer');
        })
        ->where('status', 'Active')->exists();

        if($is){
            return true;
        }
        return false;
    }

    public function notOnlyCoustomer(){
        return $this->roles->count() > 1 ? true : false;
    }

    public function roles(){
        return $this->hasMany("App\Models\Role");
    }

    public function wish_lists(){
        return $this->hasMany("App\Models\WishList");
    }

    public function addresses(){
        return $this->hasMany("App\Models\Address")->where('deleted', 'No');
    }

    public function orders(){
        return $this->hasMany("App\Models\Order");
    }

}
