<div 
    x-data="{ open: @entangle('show') }" 
    x-show="open"
    x-transition
    x-cloak
    style="display: none;"
    class="fixed inset-0 z-[1000] overflow-y-auto"
>
    <!-- Modal container -->
    <div class="flex min-h-full items-center justify-center p-4 text-center">
        <!-- Modal panel -->
        <div
            x-show="open"
            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 w-full max-w-md"
        >
            <form wire:submit.prevent="updateProduct">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <h2 class="text-xl font-bold mb-4">Edit Product</h2>

                    <div class="space-y-4">
                        <div>
                            <label class="block mb-1">Title</label>
                            <input type="text" wire:model="name" class="w-full border rounded p-2">
                            @error('title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block mb-1">Category</label>
                            <select wire:model="category_id" class="w-full border rounded p-2">
                                <option value="">-- Select --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block mb-1">Status</label>
                            <select wire:model="status" class="w-full border rounded p-2">
                                <option value="active">active</option>
                                <option value="draft">Draft</option>
                                <option value="archived">archived</option>
                            </select>
                            @error('status') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button 
                        type="submit"
                        class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 sm:ml-3 sm:w-auto"
                    >
                        Save Changes
                    </button>
                    <button 
                        type="button" 
                        @click="open = false" 
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
                    >
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>