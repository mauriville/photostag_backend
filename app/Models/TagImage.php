<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagImage extends Model
{
    use HasFactory;
    protected $table = 'TagImage';
    public $incrementing = false;
    protected $primaryKey = null;

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'Tag');
    }
    public function image()
    {
        return $this->belongsTo(Image::class, 'Image');
    }
}
