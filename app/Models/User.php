<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    // Begin:: relationship
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }
    public function user_role()
    {
        return $this->hasOne(BaseUserRole::class);
    }
    public function roleGroup()
    {
        if ($this->id) {
            // $role = BaseUserRole::select(
            //     "base_roles.*",
            //     "base_groups.group_name",
            //     "base_groups.app_url",
            // )
            //     ->where("base_user_roles.user_id", $this->id)
            //     ->leftJoin("base_roles", "base_user_roles.role_id", '=', "base_roles.id")
            //     ->leftJoin("base_groups", "base_roles.group_id", '=', "base_groups.id")
            //     ->first();
            // $this->role = $role;

            return $this;
        }

        return null;
    }
    // End:: relationship
}
