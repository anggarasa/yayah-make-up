<?php

namespace App\Livewire\Pages\Admin\Diskon;

use App\Models\Diskon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.admin-layout')]
#[On('create-diskon')]
class ManagementDiskon extends Component
{
    public function render()
    {
        return view('livewire.pages.admin.diskon.management-diskon', [
            'diskons' => Diskon::latest()->get(),
        ]);
    }
}
