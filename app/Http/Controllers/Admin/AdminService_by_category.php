<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServieRequest;
use App\Models\Service;
use App\Models\ServiceCategory;
use GuzzleHttp\Psr7\ServerRequest;
use Illuminate\Http\Request;

class AdminService_by_category extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::paginate(10);
        return view('Admin.Service.index', compact('services'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ServiceCategory::all();
        return view('Admin.Service.add', compact('categories'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(ServieRequest $request)
    {
        $data = $request->all();
        // Handle file uploads
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/services'), $filename);
            $data['image'] = $filename;
        }
        // Handle thumbnail upload for the service
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/services/thumbnails'), $filename);
            $data['thumbnail'] = $filename; // Store the filename in your $data array
        }
        // Create the new service record using $data
        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Dịch vụ đã được tạo thành công');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $categories = ServiceCategory::all();
        $service = Service::where('slug', $slug)->firstOrFail();
        return view('Admin.Service.edit', compact('service', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServieRequest $request, $slug)
    {
        // Tìm service bằng slug
        $service = Service::where('slug', $slug)->firstOrFail();

        // Cập nhật dữ liệu service
        $data = $request->all();

        // Xử lý upload file, tương tự như trong phương thức store
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/services'), $filename);
            $data['image'] = $filename;
        }

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/services/thumbnails'), $filename);
            $data['thumbnail'] = $filename;
        }

        // Cập nhật bản ghi
        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Dịch vụ đã được cập nhật thành công');
    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {

        $service = Service::findOrFail($id);
        $imagePath1 = public_path('images/services/' . $service->image);
        $imagePath2 = public_path('images/services/thumbnails/' . $service->thumbnail);
        if ($service->image && file_exists($imagePath1)) {
            unlink($imagePath1);
        }
        if ($service->image && file_exists($imagePath2)) {
            unlink($imagePath2);
        }
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Danh mục đã được xóa thành công!');
    }
}
