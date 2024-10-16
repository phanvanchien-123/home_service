
<form class="form-horizontal" 
action="{{ isset($category) ? route('update.service_categories', $category->slug) : route('store.service_categories') }}" 
method="POST" 
enctype="multipart/form-data">

@csrf
@if(isset($category))
  @method('PUT') <!-- Use PUT method for updates -->
@endif

<div class="form-group">
  <label for="name" class="control-label col-sm-3">Tên danh mục</label>
  <div class="col-sm-9">
      <input type="text" class="form-control" name="name" id="name" 
             value="{{ old('name', isset($category) ? $category->name : '') }}" >
      @error('name')
          <span class="text-danger">{{ $message }}</span>
      @enderror
  </div>
</div>

<div class="form-group">
  <label for="slug" class="control-label col-sm-3">Slug</label>
  <div class="col-sm-9">
      <input type="text" class="form-control" name="slug" id="slug" 
             value="{{ old('slug', isset($category) ? $category->slug : '') }}" readonly >
      @error('slug')
          <span class="text-danger">{{ $message }}</span>
      @enderror
  </div>
</div>

<div class="form-group">
  <label for="image" class="control-label col-sm-3">Ảnh Danh mục</label>
  <div class="col-sm-5">
      <input type="file" class="form-control-file" name="image" id="image" accept="image/*" onchange="previewImage(event)">
      <img id="imagePreview" src="{{ isset($category) && $category->image ? asset('images/categories/' . $category->image) : '#' }}" alt="" width="60%" 
           style="display: {{ isset($category) && $category->image ? 'block' : 'none' }};" />
      @error('image')
          <span class="text-danger">{{ $message }}</span>
      @enderror
  </div>
</div>

<button type="submit" class="btn btn-success pull-right">
  {{ isset($category) ? 'Cập nhật danh mục' : 'Thêm danh mục' }}
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
