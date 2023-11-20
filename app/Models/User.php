<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Shanmuga\LaravelEntrust\Traits\LaravelEntrustUserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Helpers\ImageHelper;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\ProfileChangeNotification;
use NotificationChannels\WebPush\HasPushSubscriptions;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, LaravelEntrustUserTrait, HasPushSubscriptions;

    use MainModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
        'active',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
    ];
    protected $dateFormat = 'U';
    protected $dates = ['created_at', 'updated_at'];
    protected $appends = ['role_array'];

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

    public function scopeVerified($q)
    {
        return $q->whereNotNull('email_verified_at');
    }

    public function getVerified()
    {
        return $this->verified()->get();
    }

    public function getRoleArrayAttribute($id)
    {
        $arr = [];
        if (isset($this->roles)) {
            foreach ($this->roles as  $value) {
                $arr[$value->id] = $value->name;
            }
        }
        return $arr;
    }

    public function roleArrayById($id)
    {
        $existing_role = Self::findOrFail($id);
        $arr = [];
        if ($existing_role->roles) {
            foreach ($existing_role->roles as  $value) {
                $arr[] = $value->id;
            }
        }
        return $arr;
    }

    public function refreshRoles($id, $role)
    {
        $user = Self::findOrFail($id);
        // remove any roles tagged in this user.
        foreach ($user->roles as $userRole) {
            $user->roles()->detach($userRole->id);
        }
        // attach the new role using the `EntrustUserTrait` `attachRole()`
        $user->roles()->attach($role);
    }

    public static function getAppRoles()
    {
        return ['customer', 'seller'];
    }

    public function scopeActive($query)
    {
        return $query->whereActive(1);
    }

}
