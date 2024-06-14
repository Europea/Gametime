<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRelation extends Model
{
    use HasFactory;

    protected $table = 'user_relations';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'related_user_id',
    ];

    public function relatedUsers()
    {
        return $this->belongsToMany(User::class, 'user_relations', 'user_id', 'related_user_id');
    }

}
