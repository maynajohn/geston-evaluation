<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['titre', 'date', 'type'];

    protected $casts = [
        'date' => 'datetime:Y-m-d',  
    ];
}
