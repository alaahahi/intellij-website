<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'user_agent',
        'referer',
        'source',
        'url',
        'page',
        'country',
        'city',
        'device',
        'browser',
        'platform',
        'visited_at',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];

    /**
     * تحديد مصدر الزيارة من Referer
     */
    public static function detectSource($referer)
    {
        if (empty($referer)) {
            return 'direct';
        }

        $referer = strtolower($referer);

        // Google
        if (strpos($referer, 'google.') !== false || strpos($referer, 'google.com') !== false) {
            return 'google';
        }

        // Facebook
        if (strpos($referer, 'facebook.com') !== false || strpos($referer, 'fb.com') !== false) {
            return 'facebook';
        }

        // Twitter
        if (strpos($referer, 'twitter.com') !== false || strpos($referer, 'x.com') !== false) {
            return 'twitter';
        }

        // Instagram
        if (strpos($referer, 'instagram.com') !== false) {
            return 'instagram';
        }

        // LinkedIn
        if (strpos($referer, 'linkedin.com') !== false) {
            return 'linkedin';
        }

        // YouTube
        if (strpos($referer, 'youtube.com') !== false || strpos($referer, 'youtu.be') !== false) {
            return 'youtube';
        }

        // Bing
        if (strpos($referer, 'bing.com') !== false) {
            return 'bing';
        }

        // Yahoo
        if (strpos($referer, 'yahoo.com') !== false) {
            return 'yahoo';
        }

        // Other
        return 'other';
    }

    /**
     * تحديد نوع الجهاز من User Agent
     */
    public static function detectDevice($userAgent)
    {
        if (empty($userAgent)) {
            return 'unknown';
        }

        $userAgent = strtolower($userAgent);

        if (strpos($userAgent, 'mobile') !== false || strpos($userAgent, 'android') !== false || strpos($userAgent, 'iphone') !== false) {
            return 'mobile';
        }

        if (strpos($userAgent, 'tablet') !== false || strpos($userAgent, 'ipad') !== false) {
            return 'tablet';
        }

        return 'desktop';
    }

    /**
     * تحديد المتصفح من User Agent
     */
    public static function detectBrowser($userAgent)
    {
        if (empty($userAgent)) {
            return 'unknown';
        }

        $userAgent = strtolower($userAgent);

        if (strpos($userAgent, 'chrome') !== false && strpos($userAgent, 'edg') === false) {
            return 'chrome';
        }

        if (strpos($userAgent, 'firefox') !== false) {
            return 'firefox';
        }

        if (strpos($userAgent, 'safari') !== false && strpos($userAgent, 'chrome') === false) {
            return 'safari';
        }

        if (strpos($userAgent, 'edg') !== false) {
            return 'edge';
        }

        if (strpos($userAgent, 'opera') !== false || strpos($userAgent, 'opr') !== false) {
            return 'opera';
        }

        return 'other';
    }

    /**
     * تحديد النظام من User Agent
     */
    public static function detectPlatform($userAgent)
    {
        if (empty($userAgent)) {
            return 'unknown';
        }

        $userAgent = strtolower($userAgent);

        if (strpos($userAgent, 'windows') !== false) {
            return 'windows';
        }

        if (strpos($userAgent, 'mac') !== false || strpos($userAgent, 'darwin') !== false) {
            return 'macos';
        }

        if (strpos($userAgent, 'linux') !== false) {
            return 'linux';
        }

        if (strpos($userAgent, 'android') !== false) {
            return 'android';
        }

        if (strpos($userAgent, 'iphone') !== false || strpos($userAgent, 'ipad') !== false) {
            return 'ios';
        }

        return 'other';
    }
}

