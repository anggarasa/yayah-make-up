<?php

namespace App\Livewire\Pages\Admin\Diskon;

use App\Models\DiskonProduct as ModelsDiskonProduct;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.admin-layout')]
#[On('create-diskon-produk')]
class DiskonProduct extends Component
{
    public function render()
    {
        return view('livewire.pages.admin.diskon.diskon-product', [
            'diskons' => ModelsDiskonProduct::latest()->get(),
        ]);
    }
}
