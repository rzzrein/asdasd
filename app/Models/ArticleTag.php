<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    use HasFactory;

    protected $table = 'article_tags';
    protected $fillable = [
        'article_id',
        'tag_id'
    ];

    public function article()
    {
        return $this->hasMany(Article::class);
    }

    public function tag()
    {
        return $this->hasMany(Tag::class);
    }
}
