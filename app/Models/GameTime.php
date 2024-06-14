<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameTime extends Model
{
    use HasFactory;

    protected $table = 'gametime';

    protected $fillable = [
        'kind_id',
        'datum',
        'tijd',
        'tijdafgelopen',
        'geactiveerd',
        'toepassing'
    ];

}
