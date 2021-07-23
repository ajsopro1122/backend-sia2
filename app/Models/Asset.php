<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'location',
        'contained_in',
        'value',
        'acquired_on',
        'status',
        'user_id'

    ];

    public function container() {
        return $this->belongsTo('App\Models\Asset', 'contained_in', 'id');
    }
}
