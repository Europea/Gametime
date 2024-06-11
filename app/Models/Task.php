<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'taak';
    protected $primaryKey = 'idtaak';
    public $timestamps = false;

    protected $fillable = [
        'omschrijving',
        'waardepunten',
        'datum',
        'voltooid',
        'kind_id',
        'controller_idcontroller',
    ];

    public function child()
    {
        return $this->belongsTo(User::class, 'kind_id');
    }

    public function controller()
    {
        return $this->belongsTo(User::class, 'controller_idcontroller');
    }
}
