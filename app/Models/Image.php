<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;


class Image extends Model
{
    use MainModel, SoftDeletes;

    protected $dateFormat = 'U';
    protected $fillable = [
        'type',
        'size',
        'mime_type',
        'file_name',
        'path',
        'height',
        'width',
        'parent_id',
        'attachable_type',
        'attachable_id',
    ];
    protected $appends =['url'];

    /**
     * Get all of the owning attachable models.
     */
    public function attachable()
    {
        return $this->morphTo();
    }

    public function version()
    {
        return $this->hasMany(Image::class, 'parent_id');
    }

    public function getThumbVersionAttribute()
	{
		return $this->version()->whereType('thumb')->first();
	}

	public function getMediumVersionAttribute()
	{
		return $this->version()->whereType('medium')->first();
	}

	public function getLargeVersionAttribute()
	{
		return $this->version()->whereType('large')->first();
	}

    public function getUrlAttribute()
    {
        if (env('FILESYSTEM_DRIVER') == 's3') {
            return Storage::disk('s3')->url($this->path);
        } else {
            return Storage::url($this->path);
        }
    }
}
