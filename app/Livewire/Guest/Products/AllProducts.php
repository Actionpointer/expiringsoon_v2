<?php

namespace App\Livewire\Guest\Products;

use App\Models\Product;
use App\Models\Category;
use App\Models\Store;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.frontend.customer.app')]
class AllProducts extends Component
{
    use WithPagination;

    // Filter properties
    public $search = '';
    public $selected_categories = [];
    public $selected_store = '';
    public $price_min = 0;
    public $price_max = 1000;
    public $expiry_sort = '';
    public $sort_by = 'featured';
    public $rating_filter = '';
    public $featured_only = false;

    // Computed properties for filters
    public function getProductsProperty()
    {
        $query = Product::with(['variants', 'category', 'store', 'reviews'])
            ->where('published', true)
            ->whereNotNull('approved_at')
            ->whereDoesntHave('rejected')
            ->whereHas('variants');

        // Category filter
        if (!empty($this->selected_categories)) {
            $query->whereIn('category_id', $this->selected_categories);
        }

        // Store filter
        if ($this->selected_store) {
            $query->where('store_id', $this->selected_store);
        }

        // Apply filters
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        // Price filter (using variant prices)
        if ($this->price_min > 0 || $this->price_max < 1000) {
            $query->whereHas('variants', function ($q) {
                if ($this->price_min > 0) {
                    $q->where('price', '>=', $this->price_min);
                }
                if ($this->price_max < 1000) {
                    $q->where('price', '<=', $this->price_max);
                }
            });
        }

        // Rating filter
        if ($this->rating_filter) {
            $query->whereHas('reviews', function ($q) {
                $q->havingRaw('AVG(rating) >= ?', [$this->rating_filter]);
            });
        }

        // Featured filter
        if ($this->featured_only) {
            $query->whereHas('features');
        }

        // Apply sorting
        switch ($this->sort_by) {
            case 'price_low':
                $query->whereHas('variants', function ($q) {
                    $q->orderBy('price', 'asc');
                });
                break;
            case 'price_high':
                $query->whereHas('variants', function ($q) {
                    $q->orderBy('price', 'desc');
                });
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'rating':
                $query->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating', 'desc');
                break;
            default: // featured
                $query->orderBy('created_at', 'desc');
                break;
        }

        // Expiry sorting
        if ($this->expiry_sort) {
            switch ($this->expiry_sort) {
                case '1':
                    $query->where('expire_at', '<=', now()->addMonth());
                    break;
                case '2':
                    $query->where('expire_at', '<=', now()->addMonths(2));
                    break;
                case '3':
                    $query->where('expire_at', '<=', now()->addMonths(3));
                    break;
                case '4':
                    $query->where('expire_at', '<=', now()->addMonths(4));
                    break;
                case '5':
                    $query->where('expire_at', '<=', now()->addMonths(5));
                    break;
                case '6':
                    $query->where('expire_at', '<=', now()->addMonths(6));
                    break;
            }
        }

        return $query->paginate(24);
    }

    public function getCategoriesProperty()
    {
        return Category::whereHas('products', function ($q) {
            $q->where('published', true)->whereNotNull('approved_at');
        })->get();
    }

    public function getStoresProperty()
    {
        return Store::whereHas('products', function ($q) {
            $q->where('published', true)->whereNotNull('approved_at');
        })->get();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedSelectedCategories()
    {
        $this->resetPage();
    }

    public function updatedSelectedStore()
    {
        $this->resetPage();
    }

    public function updatedPriceMin()
    {
        $this->resetPage();
    }

    public function updatedPriceMax()
    {
        $this->resetPage();
    }

    public function updatedExpirySort()
    {
        $this->resetPage();
    }

    public function updatedSortBy()
    {
        $this->resetPage();
    }

    public function updatedRatingFilter()
    {
        $this->resetPage();
    }

    public function updatedFeaturedOnly()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->reset(['search', 'selected_categories', 'selected_store', 'price_min', 'price_max', 'expiry_sort', 'sort_by', 'rating_filter', 'featured_only']);
        $this->resetPage();
    }

    protected function getListeners()
    {
        return [
            'select2ValueUpdated' => 'handleSelect2StoreChange',
            'select2MultipleValuesUpdated' => 'handleSelect2CategoriesChange',
        ];
    }

    public function handleSelect2StoreChange($id, $value, $extra = null)
    {
        if ($id === 'select2-single-store') {
            $this->selected_store = $value;
            $this->resetPage();
        }
    }

    public function handleSelect2CategoriesChange($id, $values)
    {
        if ($id === 'select2-multiple-categories') {
            $this->selected_categories = $values ?? [];
            $this->resetPage();
        }
    }

    public function render()
    {
        return view('livewire.guest.products.all-products');
    }
}
