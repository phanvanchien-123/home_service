
<form class="form-horizontal" 
action="{{ isset($slides) ? route('admin.slides.update', $slides->id) : route('admin.slides.store') }}" 
method="POST" 
enctype="multipart/form-data">

@csrf
@if(isset($slides))
  @method('PUT') <!-- Use PUT method for updates -->
@endif

<div class="form-group">
  <label for="name" class="control-label col-sm-3">Tên Slide</label>
  <div class="col-sm-9">
      <input type="text" class="form-control" name="title" id="name" 
             value="{{ old('title', isset($slides) ? $slides->title : '') }}" >
      @error('title')
          <span class="text-danger">{{ $message }}</span>
      @enderror
  </div>
</div>


<div class="form-group">
    <label for="status" class="control-label col-sm-3">Trạn Thái</label>
    <div class="col-sm-9">
        <select name="status" class="form-control" id="status" style="width: 400px;">
            <option value="1" {{ old('status', isset($service) ? $service->status : '') == '1' ? 'selected' : '' }}>Kích hoạt</option>
            <option value="0" {{ old('status', isset($service) ? $service->status : '') == '0' ? 'selected' : '' }}>Không kích hoạt</option>
        </select>
        @error('status')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group">
  <label for="image" class="control-label col-sm-3">Ảnh Danh mục</label>
  <div class="col-sm-5">
      <input type="file" class="form-control-file" name="image" id="image" accept="image/*" onchange="previewImage(event)">
      <img id="imagePreview" src="{{ isset($slides) && $slides->image ? asset('images/slides/' . $slides->image) : '#' }}" alt="" width="60%" 
           style="display: {{ isset($slides) && $slides->image ? 'block' : 'none' }};" />
      @error('image')
          <span class="text-danger">{{ $message }}</span>
      @enderror
  </div>
</div>

<button type="submit" class="btn btn-success pull-right">
  {{ isset($slides) ? 'Cập nhật danh mục' : 'Thêm danh mục' }}
</button>
</form>
                                    
                                    <script>
                                        function previewImage(event) {
                                            const imagePreview = document.getElementById('imagePreview');
                                            const file = event.target.files[0];
                                    
                                            if (file) {
                                                const reader = new FileReader();
                                                reader.onload = function(e) {
                                                    imagePreview.src = e.target.result;
                                                    imagePreview.style.display = 'block'; // Show the image
                                                };
                                                reader.readAsDataURL(file);
                                            } else {
                                                imagePreview.src = '#'; // Reset the image source
                                                imagePreview.style.display = 'none'; // Hide the image
                                            }
                                        }
                                    </script>
                                    
                                    
                                    <script>
                                        document.getElementById('name').addEventListener('input', function() {
                                            let name = this.value;
                                    
                                            // Normalize and remove diacritics
                                            let slug = name.normalize('NFD').replace(/[\u0300-\u036f]/g, '');
                                    
                                            // Convert to lowercase, remove invalid characters, and replace spaces with dashes
                                            slug = slug.toLowerCase().replace(/[^\w\s-]/g, '').replace(/\s+/g, '-');
                                    
                                            document.getElementById('slug').value = slug;
                                        });
                                    </script>
