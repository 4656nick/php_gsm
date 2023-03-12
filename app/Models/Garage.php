<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Garage extends Model
{
    protected $fillable = ['name', 'base_id'];
    use HasFactory, SoftDeletes;

    public function base()
    {
        return $this->belongsTo(Base::class);
    }

    public function statements()
    {
        return $this->hasMany(Statement::class);
    }
}