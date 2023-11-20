<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 
        'name'
    ];

    protected $dateFormat = 'U';
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $hidden = ['deleted_at'];
    
    public function articlelabel() 
    {
        return $this->hasMany(ArticleLabel::class);
    }
    
}
