<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class SitemapController extends Controller
{
    public function robots()
    {
        $sitemapUrl = url('/sitemap.xml');
        
        $robotsContent = "User-agent: *
Allow: /

# Disallow admin and private areas
Disallow: /admin/
Disallow: /dashboard/
Disallow: /profile/
Disallow: /api/

# Allow important pages
Allow: /
Allow: /about
Allow: /service
Allow: /contact
Allow: /contracts-system
Allow: /accounting-system
Allow: /feature
Allow: /testimonial
Allow: /pricing
Allow: /blog

# Sitemap location
Sitemap: {$sitemapUrl}
";

        return response($robotsContent, 200)
            ->header('Content-Type', 'text/plain');
    }

    public function index()
    {
        $baseUrl = config('app.url');
        $routes = [
            [
                'loc' => $baseUrl,
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'daily',
                'priority' => '1.0'
            ],
            [
                'loc' => $baseUrl . '/about',
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ],
            [
                'loc' => $baseUrl . '/service',
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ],
            [
                'loc' => $baseUrl . '/contact',
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.7'
            ],
            [
                'loc' => $baseUrl . '/contracts-system',
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.9'
            ],
            [
                'loc' => $baseUrl . '/accounting-system',
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.9'
            ],
            [
                'loc' => $baseUrl . '/feature',
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.7'
            ],
            [
                'loc' => $baseUrl . '/testimonial',
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.6'
            ],
            [
                'loc' => $baseUrl . '/pricing',
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ],
            [
                'loc' => $baseUrl . '/blog',
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.7'
            ],
        ];

        return response()->view('sitemap', ['routes' => $routes])
            ->header('Content-Type', 'text/xml');
    }
}

