<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SlideRequest;
use App\Models\Slide;
use Illuminate\Http\Request;

class AdminSlide extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slides = Slide::paginate(10);
        return view('Admin.Slide.index', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        return view('Admin.Slide.add',['slides' => null]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SlideRequest $request)
    {
        $data = $request->all();
        // Handle file uploads
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/slides'), $filename);
            $data['image'] = $filename;
        }
        Slide::create($data);

        return redirect()->route('admin.slides.index')->with('success', 'Slide đã được tạo thành công');
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
    public function edit($id)
{

    $slides = Slide::findOrFail($id);
    return view('Admin.Slide.edit', compact('slides'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(SlideRequest $request, $id)
    {
        
        $slides = Slide::findOrFail($id);
         $data = $request->all();
         if ($request->hasFile('image')) {
             $file = $request->file('image');
             $filename = time() . '_' . $file->getClientOriginalName();
             $file->move(public_path('images/slides'), $filename);
             $data['image'] = $filename;
         }
         // Cập nhật bản ghi
         $slides->update($data);
 
         return redirect()->route('admin.slides.index')->with('success', 'Slide đã được cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $slides = Slide::findOrFail($id);
        $imagePath = public_path('images/slides/' . $slides->image);
      
        if ($slides->image && file_exists($imagePath)) {
            unlink($imagePath);
        }
      
        $slides->delete();
        return redirect()->route('admin.slides.index')->with('success', 'Slide đã được xóa thành công!');
    }
}
