<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    /** @use HasFactory<\Database\Factories\CityFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'cities';
    protected $fillable = ['id_province', 'name', 'population'];

    public function province()
    {
        return $this->belongsTo(Province::class, 'id_province', 'id');
    }
}
