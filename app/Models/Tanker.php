<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tanker extends Model
{
    protected $fillable = ['name'];
    use HasFactory, SoftDeletes;

    public function statements()
    {
        return $this->hasMany(Statement::class);
    }
}