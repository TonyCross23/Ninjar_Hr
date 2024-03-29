<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Salary;
use App\Models\Department;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laragear\WebAuthn\WebAuthnAuthentication;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laragear\WebAuthn\Contracts\WebAuthnAuthenticatable;

class User extends Authenticatable implements WebAuthnAuthenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles, WebAuthnAuthentication;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function department(){
        return $this->belongsTo(Department::class,'department_id','id');
    }

    public function profile_img_path () {
        if($this->profile_img){
            return asset('storage/employee/' . $this->profile_img);
        }
        return null;
    }

    public function salaries () {
        return $this->hasMany(Salary::class,'user_id','id');
    }
}
