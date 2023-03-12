<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Statement extends Model
{
    protected $fillable = ['fio', 'date_of_create', 'is_signed', 'stamp', 'numbers', 'gas', 'sheet_id', 'tanker_id',  'fuel_id', 'garage_id'];
    use HasFactory, SoftDeletes;

    public function garage()
    {
        return $this->belongsTo(Garage::class);
    }

    public function fuel()
    {
        return $this->belongsTo(Fuel::class);
    }

    public function tanker()
    {
        return $this->belongsTo(Tanker::class);
    }

    public function sheet()
    {
        return $this->belongsTo(Sheet::class);
    }
}