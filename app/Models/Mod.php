<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mod extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'description',
        'contained_in',
        'value',
        'type',
        'user_id'

    ];

    public function container() {
        return $this->belongsTo('App\Models\Mod', 'contained_in', 'id');
    }
}
