<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'regionId',
    ];

    protected $casts = [
        'name' => 'array',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class, 'regionId');
    }
}
