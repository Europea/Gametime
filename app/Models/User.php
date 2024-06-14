<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the tasks for the user.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'controller_idcontroller', 'id');
    }

    /**
     * The children that belong to the parent.
     */
    public function children()
    {
        return $this->belongsToMany(User::class, 'parent_child', 'parent_id', 'child_id');
    }

    public function parents()
    {
        return $this->belongsToMany(User::class, 'parent_child', 'child_id', 'parent_id');
    }

    public function relatedUsers()
    {
        return $this->belongsToMany(User::class, 'user_relations', 'user_id', 'related_user_id');
    }

    public function childrenTasks()
    {
    return $this->hasManyThrough(Task::class, ParentChild::class, 'parent_id', 'kind_id');
    }

    public function parentChild()
{
    return $this->hasMany(ParentChild::class, 'parent_id', 'id');
}
}
