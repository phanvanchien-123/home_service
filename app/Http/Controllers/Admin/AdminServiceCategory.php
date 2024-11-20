<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class AdminServiceCategory extends Controller
{
    public function index()
    {
        $categories = ServiceCategory::paginate(5);
        return view('Admin.Category.index', compact('categories'));
    }
    public function add()
    {
        return view('Admin.Category.add', ['category' => null]);
    }

    // Store a new category
    public function store(CategoryRequest $request)
    {
        // Create a new category
        $data = $request->all();
        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/categories'), $filename);
            $data['image'] = $filename;
        }

        ServiceCategory::create($data);
        return redirect()->route('admin.service_categories')->with('success', 'Danh mục đã được tạo thành công');
      
       // return redirect()->route('admin.service_categories')->with('success', 'Danh mục đã được thêm thành công!');
    }

    // Show form for editing a category
    public function edit($slug)
    {
        $category = ServiceCategory::where('slug', $slug)->firstOrFail(); // Find by slug
        return view('Admin.Category.edit', compact('category'));
    }

    // Update an existing category
    public function update(CategoryRequest $request, $slug)
    {
        $category = ServiceCategory::where('slug', $slug)->firstOrFail(); // Find by slug

        // Update the category
        $data = $request->all();

        // Handle image upload if a new one is provided
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/categories'), $filename);
            $data['image'] = $filename;
        }

        $category->update($data);

        return redirect()->route('admin.service_categories')->with('success', 'Danh mục đã được cập nhật thành công!');
    }
    public function destroy($slug)
    {
        $category = ServiceCategory::where('slug', $slug)->firstOrFail(); // Find category by slug
        if ($category->image && file_exists(public_path('images/categories/' . $category->image))) {
            unlink(public_path('images/categories/' . $category->image)); // Remove image file from server
        }
        $category->delete(); // Delete the category from the database
        return redirect()->route('admin.service_categories')->with('success', 'Danh mục đã được xóa thành công!');
    }
    public function show($category_slug)
    {
        $category = ServiceCategory::where('slug', $category_slug)->first();
        $services = Service::where('service_category_id', $category->id)->paginate(5);
        return view('Admin.Category.show', compact('services', 'category'));
    }
}
