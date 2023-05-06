<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;
    protected $with = ['type', 'technologies'];
    protected $fillable = [
        'title',
        'description',
        'website_link',
        'slug',
        'type_id',
        'cover_image'
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }
    protected function coverPath(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                return asset('storage/' . $attributes['cover_image']);
            }
        );
    }
    protected $appends = ['cover_path'];
}
