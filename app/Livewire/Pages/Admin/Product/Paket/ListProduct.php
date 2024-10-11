<?php

namespace App\Livewire\Pages\Admin\Product\Paket;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[Layout('layouts.admin-layout')]
class ListProduct extends Component
{
    use WithPagination, WithoutUrlPagination;
    
    public function render()
    {
        return view('livewire.pages.admin.product.paket.list-product', [
            'products' => Product::latest()->paginate(8)
        ]);
    }
}
