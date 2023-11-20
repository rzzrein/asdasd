<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Shanmuga\LaravelEntrust\Models\EntrustRole;

class Role extends EntrustRole
{
    use HasFactory;
    use MainModel;

    protected $fillable = [
        'name', 'display_name', 'description', 'active'
    ];
    protected $appends = ['permission_id'];

    public function scopeActive($query)
    {
        return $query->whereActive(1);
    }

    public function scopeAdmin($query)
    {
        return $query->whereNotIn('name', User::getAppRoles());
    }

    public function getPermissionIdAttribute()
    {
        return $this->permissions->pluck('id');
    }

}
