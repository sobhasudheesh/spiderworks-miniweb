<?php

namespace Spiderworks\MiniWeb\Models;

use Illuminate\Database\Eloquent\Model;

class MediaLibrary extends Model
{
    protected $table = 'media_library';

    protected $fillable = [
        'file_name', 'file_path', 'thumb_file_path', 'file_type', 'file_size', 'dimensions', 'media_type', 'title', 'description', 'alt_text', 'is_public', 'related_type', 'related_id'
    ];

    protected $dates = ['created_at','updated_at'];

    public $uploadPath = array(
        'media' => 'uploads/media/',
        'media_thumb' => 'uploads/media/thumb/',
    );
}
