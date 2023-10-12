<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function blogs_with_tag($name)
    {
        $blogs = Tag::where('name', $name)->with('blogs')->get();
        $categories = Category::all();
        $latest = Blog::latest()->limit(2)->get();
        $catWBlog = Category::with('blogs')->get();
        $tagsWithBlogs = Tag::with('blogs')->limit(10)->get();

        return view('blog_with_tag', ['blogs' => $blogs, 'categories' => $categories, 'latest' => $latest, 'catWBlog' => $catWBlog, 'tagsWithBlogs' => $tagsWithBlogs, 'TagName' => $name]);
    }
}
