<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $dates = ['due_date'];

    const PRIORITY_LOW = 'low';
    const PRIORITY_MEDIUM = 'medium';
    const PRIORITY_HIGH = 'high';
    const PRIORITIES = [
        self::PRIORITY_LOW,
        self::PRIORITY_MEDIUM,
        self::PRIORITY_HIGH,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getLocationAttribute($value)
    {
        list($lat, $lng) = explode(',', $value);
        return [
            'lat' => $lat,
            'lng' => $lng,
        ];
    }

    public function setLocationAttribute($value)
    {
        $this->attributes['location'] = implode(',', $value);
    }
}
