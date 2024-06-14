<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScreenTimePoints extends Model
{
    use HasFactory;

    protected $fillable = [
        'minutes',
        'points',
        'parent_id',
        'child_id'
    ];

}
