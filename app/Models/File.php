<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\File as Filesystem;

class File extends Model
{
    use SoftDeletes, MainModel;

    protected $fillable = [
        'parent_id',
        'file_name',
        'path',
        'mime_type',
        'size'
    ];
    
    protected $dateFormat = 'U';
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    protected $appends = ['url', 'variant'];
    // protected $hidden = ['children', 'deleted_at'];

    public function attachable()
    {
        return $this->morphTo();
    }

    public function getUrlAttribute()
    {
        if (env('FILESYSTEM_DRIVER') == 's3') {
            return Storage::disk('s3')->url($this->path);
        }
        else {
            return Storage::url($this->path);
        }
    }


    public function parent()
    {
        return $this->belongsTo('File', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(File::class, 'parent_id');
    }

    public function getVariantAttribute()
    {
        return $this->children->pluck('url', 'type');
    }
}