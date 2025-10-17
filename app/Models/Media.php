<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    protected $fillable = [
        'user_id',
        'filename',
        'disk',
        'path',
        'extension',
        'mime',
        'size',
    ];

    protected $appends = ['url', 'human_readable_size', 'dimensions'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUrlAttribute()
    {
        return Storage::url($this->path);
    }

    public function getHumanReadableSizeAttribute()
    {
        $bytes = $this->size;
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        if ($bytes == 0) return '0 B';

        $i = floor(log($bytes, 1024));
        $size = round($bytes / pow(1024, $i), 2);

        return $size . ' ' . $units[$i];
    }

    public function getDimensionsAttribute()
    {
        if (!$this->isImage()) {
            return null;
        }

        try {
            $imagePath = storage_path('app/public/' . $this->path);
            if (file_exists($imagePath)) {
                $imageSize = getimagesize($imagePath);
                if ($imageSize) {
                    return $imageSize[0] . '×' . $imageSize[1];
                }
            }
        } catch (\Exception $e) {
            // Return null if dimensions can't be determined
        }

        return null;
    }

    public function isImage()
    {
        return in_array($this->extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']);
    }

    public function isVideo()
    {
        return in_array($this->extension, ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm']);
    }

    public function isPdf()
    {
        return $this->extension === 'pdf';
    }
}
