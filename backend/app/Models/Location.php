<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'country',
        'region',
        'city',
    ];

    public static function rules()
    {
        return [
            'ip_address' => 'required|ip',
            'country' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ];
    }
}
