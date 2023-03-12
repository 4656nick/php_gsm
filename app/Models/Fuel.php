<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fuel extends Model
{
    protected $fillable = ['type'];
    use HasFactory, SoftDeletes;

    public function statements()
    {
        return $this->hasMany(Statement::class);
    }
}