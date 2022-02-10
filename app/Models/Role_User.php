<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role_User extends Model
{
    use HasFactory;
    protected $table = 'role_user';
    public $timestamps = true;

    protected $fillable = [
        'role_id', 'user_id',
    ];

    public function users()
    {
        return $this
            ->belongsToMany('App\Models\User')
            ->withTimestamps();
    }

    public function roles()
    {
        return $this
            ->belongsToMany('App\Models\Role')
            ->withTimestamps();
    }
}
