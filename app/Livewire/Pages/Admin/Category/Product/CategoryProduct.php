<?php

namespace App\Livewire\Pages\Admin\Category\Product;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\WithoutUrlPagination;
use App\Models\CategoryProduct as ModelCategoryProduct;
use App\Livewire\Layout\Admin\Modals\Category\ModalCategoryProduct;

#[Layout('layouts.admin-layout')]
#[On('category-create')]
class CategoryProduct extends Component
{
    use WithPagination, WithoutUrlPagination;

    public function updateCategory($categoryId)
    {
        $this->dispatch('startEdit', $categoryId)->to(ModalCategoryProduct::class);
    }

    public function konfirmDelete($categoryId)
    {
        $this->dispatch('startDelete', $categoryId)->to(ModalCategoryProduct::class);
    }
    public function render()
    {
        return view('livewire.pages.admin.category.product.category-product', [
            'categories' => ModelCategoryProduct::latest()->paginate(10)
        ]);
    }
}
