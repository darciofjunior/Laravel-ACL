<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;
use App\Permission;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles() {
        $this->belongsToMany(Role::class);
    }

    public function hasPermission(Permission $permission) {
        return $this->hasAnyRoles($permission->roles);
    }

    public function hasAnyRoles($roles) {
        if(is_array($roles) || is_object($roles)) {
            return !! $roles->intersect($this->roles)->count();

            /*foreach($roles as $role) {
                return $this->hasAnyRoles($role);
            }*/
        }
        return $this->roles->contains('name', $roles);
    }
}
