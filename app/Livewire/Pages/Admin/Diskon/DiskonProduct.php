<?php

namespace App\Livewire\Pages\Admin\Diskon;

use App\Livewire\Layout\Admin\Modals\Diskon\ModalDiskonProduct;
use App\Models\DiskonProduct as ModelsDiskonProduct;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.admin-layout')]
#[On('create-diskon-produk')]
class DiskonProduct extends Component
{

    public function editDiskonProduct($id)
    {
        $this->dispatch('editDiskonProduct', $id)->to(ModalDiskonProduct::class);
    }

    public function hapusDiskonProduct($id)
    {
        $this->dispatch('hapusDiskonProduct', $id)->to(ModalDiskonProduct::class);
    }

    // Ubah active diskon product
    public function updateStatusDiskonProduct($id, $status)
    {
        $diskonProduct = ModelsDiskonProduct::find($id);
        $diskonProduct->update(['is_active' => $status]);
    }
    
    public function render()
    {
        return view('livewire.pages.admin.diskon.diskon-product', [
            'diskons' => ModelsDiskonProduct::latest()->get(),
        ]);
    }
}
