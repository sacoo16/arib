<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Employee extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    protected $fillable = [
        'first_name',
        'last_name',
        'salary',
        'department_id',
        'manager_id',
        'user_id',
    ];

    protected $appends = [
        'image',
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name .' '.$this->last_name;
    }

    public function department() : BelongsTo
    {
        return $this->belongsTo(Department::class,'department_id','id');
    }

    public function manager() : BelongsTo
    {
        return $this->belongsTo(User::class,'manager_id','id');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function tasks() : HasMany
    {
        return $this->hasMany(Task::class,'assigned_to_id','id');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getImageAttribute()
    {
        $file = $this->getMedia('image')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }
}
