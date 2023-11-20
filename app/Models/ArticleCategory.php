<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    use HasFactory;
    use MainModel;

    protected $fillable = [
        'name'
    ];
    protected $dateFormat = 'U';
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
    
}
