<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ArticleLabel extends Pivot
{
    use HasFactory;
    use MainModel;
    
    protected $table = 'article_labels';
    protected $fillable = [
        'article_id', 'label_id'
    ];

    public function articleLabel()
    {
        return $this->hasMany(ArticleLabel::class);
    }

    public function articleCategory()
    {
        return $this->belongTo(ArticleCategory::class);
    }
}
