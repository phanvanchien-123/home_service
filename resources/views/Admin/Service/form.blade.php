
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<style>
    .editor {
        height: 300px; /* Chiều cao cố định */
        overflow: auto; /* Thêm thanh cuộn */
    }
    
    
</style>
<style>
    .ck-editor__editable {
        width: 50%; /* Đặt độ rộng cố định là 200px */
        height: 200px; /* Kết hợp chiều cao nếu cần */
        overflow-y: auto; /* Bật thanh cuộn nếu cần */
    }
</style>


<div class="container mt-20">
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Tạo Dịch Vụ Mới</h4>
            </div>

            <div class="card-body">
                <form action="{{ isset($service) ? route('admin.services.update', $service->slug) : route('admin.services.store') }}" 
                    method="POST" enctype="multipart/form-data">
                  @csrf
                  @if(isset($service))
                      @method('PUT')
                  @endif

                  <!-- Tên dịch vụ -->
                  <div class="row">
                      <div class="col-md-4 mb-3">
                          <label for="name">Tên dịch vụ</label>
                          <input type="text" class="form-control" id="name" name="name" 
                                 value="{{ old('name', isset($service) ? $service->name : '') }}" 
                                 placeholder="Nhập tên dịch vụ">
                          @error('name')
                              <div class="text-danger">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="col-md-4 mb-3">
                          <label for="slug">Slug</label>
                          <input type="text" class="form-control" id="slug" name="slug" 
                                 value="{{ old('slug', isset($service) ? $service->slug : '') }}" 
                                 placeholder="Nhập slug">
                          @error('slug')
                              <div class="text-danger">{{ $message }}</div>
                          @enderror
                      </div>
                  </div>

                  <!-- Tagline -->
                  <div class="form-group mb-3">
                      <label for="tagline">Tagline</label>
                      <input type="text" name="tagline" class="form-control" id="tagline" 
                             value="{{ old('tagline', isset($service) ? $service->tagline : '') }}" 
                             placeholder="Nhập tagline" style="width: 400px;">
                      @error('tagline')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                  </div>

                  <!-- Danh mục -->
                  <div class="form-group mb-3">
                      <label for="service_category_id">Danh mục</label>
                      <select name="service_category_id" class="form-control" id="service_category_id" style="width: 400px;">
                          <option value="">Chọn Danh mục</option>
                          @foreach ($categories as $category)
                              <option value="{{ $category->id }}" 
                                  {{ isset($service) && $service->service_category_id == $category->id ? 'selected' : '' }}>
                                  {{ $category->name }}
                              </option>
                          @endforeach
                      </select>
                      @error('service_category_id')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                  </div>

                  <!-- Giá và Giảm giá -->
                  <div class="row">
                      <div class="col-md-4 mb-3">
                          <label for="price">Giá</label>
                          <input type="number" step="0.01" class="form-control" id="price" name="price" 
                                 value="{{ old('price', isset($service) ? $service->price : '') }}" 
                                 placeholder="Nhập giá">
                          @error('price')
                              <div class="text-danger">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="col-md-4 mb-3">
                          <label for="discount">Giảm giá</label>
                          <input type="number" step="0.01" class="form-control" id="discount" name="discount" 
                                 value="{{ old('discount', isset($service) ? $service->discount : '') }}" 
                                 placeholder="Nhập giảm giá">
                          @error('discount')
                              <div class="text-danger">{{ $message }}</div>
                          @enderror
                      </div>
                  </div>

                  <!-- Loại giảm giá -->
                  <div class="form-group mb-3">
                      <label for="discount_type">Loại giảm giá</label>
                      <select name="discount_type" class="form-control" id="discount_type" style="width: 400px;">
                          <option value="">Chọn loại giảm giá</option>
                          <option value="fixed" {{ old('discount_type', isset($service) ? $service->discount_type : '') == 'fixed' ? 'selected' : '' }}>
                              Cố định
                          </option>
                          <option value="percent" {{ old('discount_type', isset($service) ? $service->discount_type : '') == 'percent' ? 'selected' : '' }}>
                              Phần trăm
                          </option>
                      </select>
                      @error('discount_type')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                  </div>

                  <!-- Hình ảnh -->
                  <div class="form-group mb-3">
                      <label for="image">Image</label>
                      <input type="file" class="form-control-file" name="image" id="image" accept="image/*" onchange="previewImage1(event)" style="width: 400px;">
                      @if(isset($service) && $service->image)
                          <img src="{{ asset('images/services/' . $service->image) }}" id="imagePreview1" width="20%" style="display: block;" />
                      @else
                          <img id="imagePreview1" src="" alt="" width="20%" style="display: none;" />
                      @endif
                      @error('image')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                  </div>

                  <!-- Thumbnail -->
                  <div class="form-group mb-3">
                      <label for="thumbnail">Thumbnail</label>
                      <input type="file" class="form-control-file" name="thumbnail" id="thumbnail" accept="image/*" onchange="previewImage2(event)" style="width: 400px;">
                      @if(isset($service) && $service->thumbnail)
                          <img src="{{ asset('images/services/thumbnails/' . $service->thumbnail) }}" id="imagePreview2" width="20%" style="display: block;" />
                      @else
                          <img id="imagePreview2" src="" alt="" width="20%" style="display: none;" />
                      @endif
                      @error('thumbnail')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                  </div>

                  <!-- Mô tả -->
                  <div class="form-group mb-3">
                      <label for="description">Mô tả</label>
                      <textarea id="description" name="description" class="editor" style="width: 400px;">{{ old('description', isset($service) ? $service->description : '') }}</textarea>
                      @error('description')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                  </div>

                  <!-- Inclusion -->
                  <div class="form-group mb-3">
                      <label for="inclusion">Inclusion</label>
                      <textarea id="inclusion" name="inclusion" class="editor" style="width: 400px;">{{ old('inclusion', isset($service) ? $service->inclusion : '') }}</textarea>
                      @error('inclusion')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                  </div>

                  <!-- Exclusion -->
                  <div class="form-group mb-3">
                      <label for="exclusion">Exclusion</label>
                      <textarea id="exclusion" name="exclusion" class="editor" style="width: 400px;">{{ old('exclusion', isset($service) ? $service->exclusion : '') }}</textarea>
                      @error('exclusion')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                      {{-- Nổi bật  --}}
                  </div>
                  <div class="form-group mb-3">
                    <label for="status">Nổi Bật</label>
                    <select name="featured" class="form-control" id="featured" style="width: 400px;">
                        <option value="">Hãy chọn có nổi bật có hoặc không</option>
                        <option value="1" {{ old('featured', isset($service) ? $service->featured : '') == '1' ? 'selected' : '' }}>Có</option>
                        <option value="0" {{ old('featured', isset($service) ? $service->featured : '') == '0' ? 'selected' : '' }}>Không</option>
                    </select>
                    @error('featured')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                  <!-- Trạng thái -->
                  <div class="form-group mb-3">
                      <label for="status">Trạng thái</label>
                      <select name="status" class="form-control" id="status" style="width: 400px;">
                          <option value="1" {{ old('status', isset($service) ? $service->status : '') == '1' ? 'selected' : '' }}>Kích hoạt</option>
                          <option value="0" {{ old('status', isset($service) ? $service->status : '') == '0' ? 'selected' : '' }}>Không kích hoạt</option>
                      </select>
                      @error('status')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                  </div>

                  <button type="submit" class="btn btn-primary">{{ isset($service) ? 'Cập nhật dịch vụ' : 'Lưu dịch vụ' }}</button>
              </form>
            </div>
        </div>
    </div>
</div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error(error);
        });

    ClassicEditor
        .create(document.querySelector('#inclusion'))
        .catch(error => {
            console.error(error);
        });

    ClassicEditor
        .create(document.querySelector('#exclusion'))
        .catch(error => {
            console.error(error);
        });
});
</script>
<script>
    function previewImage1(event) {
        const imagePreview = document.getElementById('imagePreview1');
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
    function previewImage2(event) {
        const imagePreview = document.getElementById('imagePreview2');
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

