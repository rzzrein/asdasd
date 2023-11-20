<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory, MainModel;

    protected $fillable = [
        'label',
        'original_extension',
        'key',
        'path'
    ];

    protected $dateFormat = 'U';
    protected $dates = ['created_at', 'updated_at'];
}
