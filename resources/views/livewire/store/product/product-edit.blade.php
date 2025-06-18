<div>
   <form id="editProductForm" method="POST" action="{{ route('store.products.update', ['store' => $store, 'product' => $product]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ $product->description }}</textarea>
            </div>
            
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" id="category_id" name="category_id">
                    <option value="">Uncategorized</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ $product->price }}">
            </div>
            
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $product->quantity }}">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Availability</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="always_available" name="always_available" {{ $product->always_available ? 'checked' : '' }}>
                    <label class="form-check-label" for="always_available">Always Available</label>
                </div>
                
                <div class="mt-2" id="expiryField" style="{{ $product->always_available ? 'display: none;' : '' }}">
                    <label for="expire_at" class="form-label">Expiry Date</label>
                    <input type="date" class="form-control" id="expire_at" name="expire_at" value="{{ $product->expire_at ? $product->expire_at->format('Y-m-d') : '' }}">
                </div>
            </div>
        </div>
    </div>
    
    <div class="mb-3">
        <label for="photos" class="form-label">Product Images</label>
        <input type="file" class="form-control" id="photos" name="photos[]" multiple>
        
        @if(!empty($product->photos))
            <div class="mt-2">
                <div class="d-flex flex-wrap gap-2">
                    @foreach(json_decode($product->photos) as $photo)
                        <div class="position-relative">
                            <img src="{{ asset('storage/' . $photo) }}" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0" onclick="removePhoto(this, '{{ $photo }}')">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</form>

<script>
    // Toggle expiry date field based on always_available checkbox
    document.getElementById('always_available').addEventListener('change', function() {
        document.getElementById('expiryField').style.display = this.checked ? 'none' : 'block';
    });
    
    function removePhoto(button, photoPath) {
        // Add the photo to a hidden field to be removed on server
        const form = document.getElementById('editProductForm');
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'removed_photos[]';
        input.value = photoPath;
        form.appendChild(input);
        
        // Remove the photo preview
        button.parentElement.remove();
    }
</script>
</div>
