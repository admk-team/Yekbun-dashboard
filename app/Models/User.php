<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'status',
        'level'
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

    public function hasRole($role = null) {
        $role = Role::where(is_numeric($role)? 'id': 'identifier', $role)
                    ->where('status', 1)
                    ->first();

        if (! $role) return false;

        return (bool) UserRole::where('user_id', $this->id)
                              ->where('role_id', $role->id)
                              ->first();
    }

    public function hasRoles($roles = [])
    {
        foreach ($roles as $role) {
            if (! $this->hasRole($role))
                return false;
        }

        return true;
    }

    public function hasAnyRole($roles = [])
    {
        foreach ($roles as $role) {
            if ($this->hasRole($role))
                return true;
        }

        return false;
    }

    public function hasActiveRole()
    {
        $userRole = UserRole::where('user_id', $this->id)
                ->first();
        return (bool) Role::where('id', $userRole->role_id)
                        ->where('status', 1)
                        ->first();
    }

    public function assignRole($role)
    {
        $role = Role::where(is_numeric($role)? 'id': 'identifier', $role)
                    ->first();
        
        if (! $role) throw new \Exception("Role does not exists.");

        // Check if role is already assigned
        $userRole = UserRole::where('user_id', $this->id)
                            ->where('role_id', $role->id)
                            ->first();        
        if ($userRole ) return true;

        UserRole::create([
            'user_id' => $this->id,
            'role_id' => $role->id
        ]);

        return true;
    }

    public function assignRoles($roles = [])
    {
        foreach ($roles as $role) $this->assignRole($role);
    }

    public function removeRole($role)
    {
        $role = Role::where(is_numeric($role)? 'id': 'identifier', $role)
                    ->first();
        
        if (! $role) return true;

        UserRole::where('user_id', $this->id)
                ->where('role_id', $role->id)
                ->first()
                ->delete();

        return true;
    }

    public function removeRoles($roles = [])
    {
        foreach ($roles as $role) $this->removeRole($role);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function stories()
    {
        return $this->hasMany(Story::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'reported_user_id', 'id');
    }

    public function ads()
    {
        return $this->hasMany(Ads::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function City()
    {
        return $this->belongsTo(City::class);
    }
}
