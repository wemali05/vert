<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campaign extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['date_from', 'date_to', 'name', 'total_budget', 'daily_budget', 'image'];

    //Casts of the model dates
    protected $casts = [
        'from' => 'date',
        'to' => 'date'
    ];
}
