<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'name' => 'required|unique:categories'
        ]);

        $result = Category::create($validated_data);

        if ($result) {
            return redirect('categories')->with('success', 'category added successfully');
        }
    }

    public function all()
    {
        $categories = Category::all();
        return view('admin.categories.all', ['categories' => $categories]);
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', ['category' => $category]);
    }

    public function update(Request $request, $id)
    {
        $validated_data = $request->validate([
            'name' => 'required'
        ]);

        $result = Category::where('id', $id)->update($validated_data);

        if ($result) {
            return redirect('categories')->with('success', 'category updated successfully');
        }
    }

    public function delete($id)
    {
        $result = Category::destroy($id);

        if ($result) {
            return redirect('categories')->with('success', 'category deleted successfully');
        }
    }

    public function blogs_with_category($id)
    {
        $category = Category::where('id', $id)->with('blogs')->get();
        $categories = Category::all();
        $latest = Blog::latest()->limit(2)->get();
        $catWBlog = Category::with('blogs')->get();
        return view('blog_with_category', ['category' => $category, 'categories' => $categories, 'category_id' => $id, 'latest' => $latest, 'catWBlog' => $catWBlog]);
    }
}
