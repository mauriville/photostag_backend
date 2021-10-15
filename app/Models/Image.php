<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = 'Image';

    public function tagImage () {
        return $this->hasMany(TagImage::class, 'Image')->whereNull('deleted_at');
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'TagImage','Image','Tag')->whereNull('TagImage.deleted_at');
    }
}
