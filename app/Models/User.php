<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'docente_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function roles() {
        return $this
        ->belongsToMany(Role::Class)
        ->withTimestamps();
    }
    
    public function docente(){
        return $this->belongsTo(Docente::class);
    }
    
    
    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'Esta acción no está autorizada.');
    }

public function hasAnyRole($roles)
{
    if (is_array($roles)) {
        foreach ($roles as $role) {
            if ($this->hasRole($role)) {
                return true;
            }
        }
    } else {
        if ($this->hasRole($roles)) {
            return true;
        }
    }
    return false;
}

public function hasRole($role)
{
    if ($this->roles()->where('name', $role)->first()) {
        return true;
    }
    return false;
}

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
    public function scopeEmail($query,$email){
        if(trim($email!="")){
            $query->where(\DB::raw("CONCAT(email)"),"LIKE","%$email%"); 
        }
    }
    public function scopeName($query,$name){
        if(trim($name!="")){
            $query->where(\DB::raw("CONCAT(name)"),"LIKE","%$name%"); 
        }
    }
    public function scopeRole_user($query,$role_user){
        if(trim($role_user!="")){
            $query->join('role_user','users.id','=','role_user.user_id')
                  ->join('roles','role_user.role_id', '=','roles.id')
                  ->where('roles.name',"LIKE","%$role_user%")
                  ->select('users.*');  
        }
    }

}
