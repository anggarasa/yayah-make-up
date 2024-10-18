<?php

namespace App\Livewire\Pages\User;

use App\Models\Product;
use Livewire\Component;

class Home extends Component
{
    public $perPage = 8;
    public $totalData;

    public function mount()
    {
        $this->totalData = Product::count();
    }

    public function loadMore()
    {
        $this->perPage += 8;
    }
    
    public function render()
    {
        return view('livewire.pages.user.home', [
            'products' => Product::latest()->take($this->perPage)->get()
        ]);
    }
}
