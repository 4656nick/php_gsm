<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sheet extends Model
{
    protected $fillable = ['name', 'city_id'];
    use HasFactory, SoftDeletes;

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function statements()
    {
        return $this->hasMany(Statement::class);
    }
}