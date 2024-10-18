<?php

namespace App\Livewire\Pages\User;

use App\Models\CategoryProduct;
use Livewire\Component;

class DetailCategoryUser extends Component
{
    public $productCategory;

    public function mount($slug)
    {
        $this->productCategory = CategoryProduct::where('slug', $slug)->get();
    }
    
    public function render()
    {
        return view('livewire.pages.user.detail-category-user');
    }
}
