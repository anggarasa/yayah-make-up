<?php

namespace App\Livewire\Pages\User\Category;

use Livewire\Component;
use App\Models\CategoryProduct;

class DetailCategory extends Component
{
    public $category;

    public function mount($slug)
    {
        $this->category = CategoryProduct::where('slug', $slug)->firstOrFail();
    }
    
    public function render()
    {
        return view('livewire.pages.user.category.detail-category');
    }
}
