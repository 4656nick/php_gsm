<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    protected $fillable = ['name'];
    use HasFactory, SoftDeletes;

    public function sheets()
    {
        return $this->hasMany(Sheet::class);
    }
}