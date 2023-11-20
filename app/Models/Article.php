<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Cores\Imageable;

class Article extends Model
{
    use HasFactory, MainModel, Imageable;

    protected $fillable = [
        'title',
        'slug',
        'article_category_id',
        'body',
        'author_name',
        'active',
        'active_footer',
        'short_description',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'alt_image',
    ];

    protected $dateFormat = 'U';
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $hidden = ['deleted_at'];
    protected $appends = ['label_id', 'tag_ids'];

    public function image()
    {
        return $this->morphOne(Image::class, 'attachable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id');
    }

    public function articleLabel()
    {
        return $this->hasMany(ArticleLabel::class);
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class, 'article_labels');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tags')->orderBy('order');
    }

    public function getLabelIdAttribute()
    {

        return $this->labels->pluck('id');
    }

    public function getTagIdsAttribute()
    {

        return $this->tags->pluck('id');
    }

    public function labelArrayById($id)
    {
        $existing_label = Self::findOrFail($id);
        $arr = [];
        if ($existing_label->lables) {
            foreach ($existing_label->lables as $value) {
                $arr[] = $value->id;
            }
        }
        return $arr;
    }

    public function refreshLabels($id, $label)
    {
        $article = Self::findOrFail($id);
        // remove any roles tagged in this user.
        foreach ($article->lables as $articleLabel) {
            $article->lables()->detach($articleLabel->id);
        }
        // attach the new role using the `EntrustUserTrait` `attachRole()`
        $article->lables()->attach($article);
    }
}
