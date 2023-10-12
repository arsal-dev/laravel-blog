<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function home()
    {
        $blogs = Blog::with('category')->limit(10)->get();
        $categories = Category::all();
        $latest = Blog::latest()->limit(2)->get();
        $catWBlog = Category::with('blogs')->get();

        $tagsWithBlogs = Tag::with('blogs')->limit(10)->get();

        return view('home', ['blogs' => $blogs, 'categories' => $categories, 'latest' => $latest, 'catWBlog' => $catWBlog, 'tagsWithBlogs' => $tagsWithBlogs]);
    }

    public function show($id)
    {
        $blog = Blog::where('id', $id)->with('tags')->get();
        $catWBlog = Category::with('blogs')->get();
        $latest = Blog::latest()->limit(2)->get();
        return view('blogs.show', ['blog' => $blog[0], 'catWBlog' => $catWBlog, 'latest' => $latest]);
    }

    public function blog_form()
    {
        return view('admin.blogs.create', ['categories' => Category::all()]);
    }

    public function blog_post(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:blogs',
            'excerpt' => 'required',
            'body' => 'required',
            'thumbnail' => 'required|mimes:png,jpg,jpeg|max:10000',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|string'
        ]);

        $tags = $request->input('tags');

        $tagArray = explode(',', $tags);
        $tagArray = array_map('trim', $tagArray); // Trim whitespace
        $tagArray = array_filter($tagArray); // Remove empty tags

        // Find existing tags by name and store them in an array
        $existingTags = Tag::whereIn('name', $tagArray)->get();

        // Create new tags and remove existing tags from $tagArray
        foreach ($existingTags as $existingTag) {
            $key = array_search($existingTag->name, $tagArray);
            if ($key !== false) {
                unset($tagArray[$key]);
            }
        }

        $image = $request->file('thumbnail');
        $image_name = $this->uploadImage($image);

        $result = Blog::create([
            'title' => $request->input('title'),
            'excerpt' => $request->input('excerpt'),
            'body' => $request->input('body'),
            'thumbnail' => $image_name,
            'category_id' => $request->input('category_id')
        ]);

        // Create new tags and associate them with the blog post
        foreach ($tagArray as $tagName) {
            $tag = Tag::create(['name' => $tagName]);
            $result->tags()->attach($tag->id);
        }

        if ($result) {
            return redirect('/')->with('success', 'blog created successfully');
        }
    }

    public function all()
    {
        $blogs = Blog::with('category')->get();
        return view('admin.blogs.all', ['blogs' => $blogs]);
    }

    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('admin.blogs.edit', ['blog' => $blog]);
    }

    public function update(Request $request, $id)
    {
        $thumbnail = Blog::where('id', $id)->select('thumbnail')->get();

        $thumbnail = $thumbnail[0]->thumbnail;

        $validated_data = $request->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
        ]);

        $image = $request->file('thumbnail');

        if ($image) {
            $result = Storage::delete('public/' . $thumbnail);
            if ($result) {
                $image_name = $this->uploadImage($image);

                $result = Blog::where('id', $id)->update([
                    'title' => $request->input('title'),
                    'excerpt' => $request->input('excerpt'),
                    'body' => $request->input('body'),
                    'thumbnail' => $image_name,
                ]);

                if ($result) {
                    return redirect('/blogs')->with('success', 'blog updated successfully');
                }
            }
        } else {
            $result = Blog::where('id', $id)->update($validated_data);
            if ($result) {
                return redirect('/blogs')->with('success', 'blog updated successfully');
            }
        }
    }

    public function uploadImage($image)
    {
        $image_name =  Str::random(20) . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public', $image_name);
        return $image_name;
    }

    public function delete($id)
    {
        $blog = Blog::find($id);

        $thumbnail = $blog->thumbnail;

        $result = Storage::delete('public/' . $thumbnail);
        if ($result) {
            $result = Blog::destroy($id);
            if ($result) {
                return redirect('/blogs')->with('success', 'blog deleted successfully');
            }
        }
    }
}
