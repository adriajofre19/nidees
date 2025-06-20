<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fire extends Model
{
    protected $fillable = [
        'name',
        'horario',
        'date',
        'location',
    ];

    /**
     * Get the formatted date for the fire.
     *
     * @return string
     */
    public function getFormattedDateAttribute()
    {
        return $this->date->format('d-m-Y');
    }
}
