<?php

namespace App\Livewire\Store\Product;

use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public Store $store;
    
    // Search and filter properties
    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 10;
    public $categoryFilter = '';
    public $statusFilter = '';
    public $expiryFilter = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
        'categoryFilter' => ['except' => ''],
        'statusFilter' => ['except' => ''],
        'expiryFilter' => ['except' => ''],
    ];

    protected $listeners = [
        'confirmProductDeletion' => 'confirmDelete',
        'deleteProduct' => 'deleteProduct',
        'publishProduct' => 'publishProduct',
        'unpublishProduct' => 'unpublishProduct',
    ];

    public function mount($store)
    {
        $this->store = $store;
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingExpiryFilter()
    {
        $this->resetPage();
    }

    public function confirmDelete($productId)
    {
        $this->dispatchBrowserEvent('show-delete-confirmation', [
            'title' => 'Delete Product',
            'text' => 'Are you sure you want to delete this product? This action cannot be undone.',
            'productId' => $productId
        ]);
    }

    public function deleteProduct($productId)
    {
        $product = Product::find($productId);
        
        if ($product && $product->store_id == $this->store->id) {
            $product->delete();
            session()->flash('success', 'Product deleted successfully');
        } else {
            session()->flash('error', 'Unable to delete product');
        }
    }

    public function publishProduct($productId)
    {
        $product = Product::find($productId);
        
        if ($product && $product->store_id == $this->store->id) {
            $product->published = true;
            $product->save();
            session()->flash('success', 'Product published successfully');
        } else {
            session()->flash('error', 'Unable to publish product');
        }
    }

    public function unpublishProduct($productId)
    {
        $product = Product::find($productId);
        
        if ($product && $product->store_id == $this->store->id) {
            $product->published = false;
            $product->save();
            session()->flash('success', 'Product unpublished successfully');
        } else {
            session()->flash('error', 'Unable to unpublish product');
        }
    }

    public function getProductsProperty()
    {
        return Product::where('store_id', $this->store->id)
            ->when($this->search, function($query) {
                return $query->where(function($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%')
                        ->orWhere('slug', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->categoryFilter, function($query) {
                return $query->where('category_id', $this->categoryFilter);
            })
            ->when($this->statusFilter !== '', function($query) {
                if ($this->statusFilter === 'published') {
                    return $query->where('published', true);
                } elseif ($this->statusFilter === 'draft') {
                    return $query->where('published', false);
                } elseif ($this->statusFilter === 'approved') {
                    return $query->whereNotNull('approved_at');
                } elseif ($this->statusFilter === 'pending') {
                    return $query->whereNull('approved_at');
                }
            })
            ->when($this->expiryFilter !== '', function($query) {
                if ($this->expiryFilter === 'expiring-soon') {
                    // Products expiring within 30 days
                    return $query->whereNotNull('expire_at')
                        ->where('expire_at', '<=', now()->addDays(30))
                        ->where('expire_at', '>', now());
                } elseif ($this->expiryFilter === 'expired') {
                    return $query->where(function($query) {
                        $query->whereNotNull('expire_at')
                            ->where('expire_at', '<', now());
                    });
                } elseif ($this->expiryFilter === 'no-expiry') {
                    return $query->where(function($query) {
                        $query->whereNull('expire_at')
                            ->orWhere('always_available', true);
                    });
                }
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function getStoreCategoriesProperty()
    {
        // Get all unique category IDs from products in this store
        $categoryIds = Product::where('store_id', $this->store->id)
            ->distinct()
            ->pluck('category_id')
            ->filter(); // Remove null values
        
        // Fetch the categories
        return Category::whereIn('id', $categoryIds)
            ->orderBy('name')
            ->get();
    }

    public function render()
    {
        return view('livewire.store.product.product-list')
        ->extends('layouts.frontend.store.app')->section('content');
    }
}
