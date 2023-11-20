<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $dateFormat = 'U';

    protected $fillable = [
        'name',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keyword',
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
