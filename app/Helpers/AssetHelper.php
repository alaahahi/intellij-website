<?php

if (!function_exists('asset_public')) {
    /**
     * Generate an asset path with public prefix when index.php is in root
     * 
     * @param  string  $path
     * @return string
     */
    function asset_public($path)
    {
        // إذا كان index.php في الجذر، أضف /public للمسار
        $publicPath = '/public/' . ltrim($path, '/');
        return asset($publicPath);
    }
}

