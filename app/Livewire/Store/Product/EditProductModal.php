<?php

namespace App\Livewire\Store\Product;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class EditProductModal extends Component
{
    public $show = false;
    public $productId;
    public $name;
    public $category_id;
    public $status = 'draft';

   
    #[On('editProductRequest')]
    public function loadProduct($id)
    {
        $product = Product::findOrFail($id);
    
        $this->productId = $product->id;
        $this->name = $product->name;
        $this->category_id = $product->category_id;
        $this->status = $product->status ?? 'draft';
        $this->show = true;
        
       
    }

    public function updateProduct()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required',
        ]);

        try {
            $product = Product::findOrFail($this->productId);
            $originalData = $product->getOriginal(); // Get data before update
            $product->update($validated);
            $updatedData = $product->fresh()->toArray(); // Get refreshed data

            // Detailed logging
            Log::channel('product_updates')->info('Product updated', [
                'product_id' => $this->productId,
                'updated_by' => auth()->id() ?? 'system',
                'original_data' => $originalData,
                'updated_data' => $updatedData,
                'changed_fields' => array_diff_assoc($updatedData, $originalData),
                'timestamp' => now()->toDateTimeString()
            ]);

            session()->flash('success', 'Product updated successfully!');
            $this->dispatch('productUpdated', productId: $this->productId);
            $this->show = false;

        } catch (\Exception $e) {
            Log::error('Product update failed', [
                'error' => $e->getMessage(),
                'product_id' => $this->productId,
                'input_data' => $validated
            ]);
            
            session()->flash('error', 'Update failed: ' . $e->getMessage());
        }
}

    protected $rules = [
    'status' => 'required|in:active,draft,archived',
];

public function updatedStatus($value)
{
    $this->validateOnly('status');
    
    // Optional: Add any immediate save logic
    // $this->saveStatus();
}

    


    public function removePhoto($photoPath)
    {
        // Add to removed photos array
        if (!isset($this->productData['removed_photos'])) {
            $this->productData['removed_photos'] = [];
        }
        $this->productData['removed_photos'][] = $photoPath;
    }

    public function updatedProductDataAlwaysAvailable($value)
    {
        $this->dispatchBrowserEvent('toggleExpiryField', ['show' => !$value]);
    }

    public function updatedPhotos()
    {
        $this->validate([
            'photos.*' => 'image|max:2048', // 2MB max
        ]);
        
        // Store the photos temporarily
        // You'll process them in the update method
    }

    
    public function render()
    {
        return view('livewire.store.product.edit-product-modal', ['categories' => Category::all(),
        'products' => Product::paginate(10)
    ]);
    }
}
