<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_route',
        'title',
        'description',
        'video_url',
        'thumbnail',
        'duration',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * الحصول على اسم المشروع
     */
    public function getProjectNameAttribute()
    {
        $projects = [
            'accounting-system' => 'برنامج المحاسب الذكي',
            'contracts-system' => 'نظام عقود بيع السيارات',
            'dream-city-mall' => 'شركة الهدف المباشر',
        ];

        return $projects[$this->project_route] ?? $this->project_route;
    }

    /**
     * الحصول على نوع الفيديو (youtube/vimeo)
     */
    public function getVideoTypeAttribute()
    {
        if (str_contains($this->video_url, 'youtube.com') || str_contains($this->video_url, 'youtu.be')) {
            return 'youtube';
        } elseif (str_contains($this->video_url, 'vimeo.com')) {
            return 'vimeo';
        }
        return null;
    }

    /**
     * الحصول على ID الفيديو
     */
    public function getVideoIdAttribute()
    {
        if ($this->video_type === 'youtube') {
            if (str_contains($this->video_url, 'youtube.com/watch?v=')) {
                parse_str(parse_url($this->video_url, PHP_URL_QUERY), $params);
                return $params['v'] ?? null;
            } elseif (str_contains($this->video_url, 'youtu.be/')) {
                return substr(parse_url($this->video_url, PHP_URL_PATH), 1);
            }
        } elseif ($this->video_type === 'vimeo') {
            return (int) substr(parse_url($this->video_url, PHP_URL_PATH), 1);
        }
        return null;
    }

    /**
     * الحصول على رابط الصورة المصغرة
     */
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            return $this->thumbnail;
        }

        if ($this->video_type === 'youtube' && $this->video_id) {
            return "https://img.youtube.com/vi/{$this->video_id}/hqdefault.jpg";
        }

        return asset('img/video-placeholder.jpg');
    }

    /**
     * الحصول على رابط embed
     */
    public function getEmbedUrlAttribute()
    {
        if ($this->video_type === 'youtube' && $this->video_id) {
            return "https://www.youtube.com/embed/{$this->video_id}";
        } elseif ($this->video_type === 'vimeo' && $this->video_id) {
            return "https://player.vimeo.com/video/{$this->video_id}";
        }
        return null;
    }
}
