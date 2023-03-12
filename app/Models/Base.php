<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Base extends Model
{
    protected $fillable = ['name', 'code'];
    use HasFactory, SoftDeletes;

    public function garages()
    {
        return $this->hasMany(Garage::class);
    }
}