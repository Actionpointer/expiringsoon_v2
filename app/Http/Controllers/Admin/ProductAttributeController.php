<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use App\Models\ProductOption;
use Illuminate\Support\Str;

class ProductAttributeController extends Controller
{
    public function index()
    {
        // Get all attributes for statistics
        $allAttributes = ProductAttribute::all();
        
        // Get paginated attributes for display
        $attributes = ProductAttribute::withCount('productOptions')->paginate(10);
        
        // Calculate statistics
        $active_attributes = $allAttributes->where('is_active', 1)->count();
        
        // Get total product options count
        $product_options_count = ProductOption::count();
        
        return view('settings.attributes.index', compact(
            'attributes',
            'active_attributes',
            'product_options_count'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:product_attributes',
            'options' => 'nullable|string',
            'is_active' => 'nullable|boolean'
        ]);

        $attribute = new ProductAttribute();
        $attribute->name = $request->name;
        $attribute->options = $request->options;
        $attribute->is_active = $request->has('is_active') ? 1 : 0;
        $attribute->save();

        return redirect()
            ->route('admin.settings.attributes.index')
            ->with('success', 'Attribute created successfully');
    }

    public function update(Request $request)
    {
        $request->validate([
            'attribute_id' => 'required|exists:product_attributes,id',
            'name' => 'required|string|max:50|unique:product_attributes,name,' . $request->attribute_id,
            'options' => 'nullable|string',
            'is_active' => 'nullable|boolean'
        ]);

        $attribute = ProductAttribute::findOrFail($request->attribute_id);
        $attribute->name = $request->name;
        $attribute->options = $request->options;
        $attribute->is_active = $request->has('is_active') ? 1 : 0;
        $attribute->save();

        return redirect()
            ->route('admin.settings.attributes.index')
            ->with('success', 'Attribute updated successfully');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'attribute_id' => 'required|exists:product_attributes,id'
        ]);

        $attribute = ProductAttribute::findOrFail($request->attribute_id);
        
        // Delete related product options
        $attribute->productOptions()->delete();
        
        // Delete the attribute
        $attribute->delete();

        return redirect()
            ->route('admin.settings.attributes.index')
            ->with('success', 'Attribute deleted successfully');
    }
} 