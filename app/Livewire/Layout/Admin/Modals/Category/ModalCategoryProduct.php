<?php

namespace App\Livewire\Layout\Admin\Modals\Category;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\CategoryProduct;
use Livewire\Attributes\Validate;
use App\Livewire\Pages\Admin\Category\Product\CategoryProduct as ProductCategoryProduct;
use Livewire\Attributes\On;

class ModalCategoryProduct extends Component
{
    #[Validate('required|string|max:255')]
    public $name;

    #[Validate('required|unique:category_products,slug')]
    public $slug;

    public $categoryId;
    
    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function resetInput()
    {
        $this->reset(['name', 'slug', 'categoryId']);
        $this->dispatch('close-category-product-modal');
        $this->dispatch('close-update-category-product-modal');
        $this->dispatch('close-konfirmasi-delete-modal');
    }

    #[On('startEdit')]
    public function startEdit($categoryId)
    {
        $this->resetInput();
        $this->categoryId = $categoryId;
        $category = CategoryProduct::findOrFail($categoryId);
        $this->name = $category->name;
        $this->slug = $category->slug;

        $this->dispatch('update-category-product-modal');
    }

    #[On('startDelete')]
    public function startDelete($categoryId)
    {
        $this->resetInput();
        $this->categoryId = $categoryId;
        $category = CategoryProduct::findOrFail($categoryId);
        $this->name = $category->name;

        $this->dispatch('confirmasi-delete-modal');
    }

    public function saveProduct()
    {
        $this->generateSlug();

        
        try {
            $this->validate();
            
            if ($this->categoryId) {
                $category = CategoryProduct::findOrFail($this->categoryId);
                $category->update([
                    'name' => $this->name,
                    'slug' => $this->slug,
                ]);

                $this->dispatch('close-update-category-product');
                $this->dispatch('modal-success-notifikasi');
            } else {
                CategoryProduct::create([
                    'name' => $this->name,
                   'slug' => $this->slug,
                ]);

                $this->dispatch('close-category-product-modal');
                $this->dispatch('notifikasi-success-modal');
            }
            
            $this->resetInput();
            $this->dispatch('category-create')->to(ProductCategoryProduct::class);
        } catch (\Exception $e) {
            $this->resetInput();
            $this->dispatch('notifikasi-error-modal');
        }
    }

    public function deleteProduct()
    {
        $category = CategoryProduct::findOrFail($this->categoryId);
        if ($category) {
            $category->delete();
        }
        $this->resetInput();
        $this->dispatch('close-konfirmasi-delete-modal');
        $this->dispatch('modal-success-notifikasi-delete');
        $this->dispatch('category-create')->to(ProductCategoryProduct::class);
    }
    

    
    public function render()
    {
        return view('livewire.layout.admin.modals.category.modal-category-product');
    }
}
