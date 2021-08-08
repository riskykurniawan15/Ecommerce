<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sitemap;
use App\Post;

class SitemapController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        foreach ($posts as $post) {
            Sitemap::addTag(url($post->id), $post->updated_at, 'daily', '0.8');
        }
        return Sitemap::render();
    }
}
