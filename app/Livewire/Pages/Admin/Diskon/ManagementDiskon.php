<?php

namespace App\Livewire\Pages\Admin\Diskon;

use App\Livewire\Layout\Admin\Modals\Diskon\ModalManagementDiskon;
use App\Models\Diskon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[Layout('layouts.admin-layout')]
#[On('create-diskon')]
class ManagementDiskon extends Component
{
    use WithPagination, WithoutUrlPagination;
    
    public function editDiskon($diskonId)
    {
        $this->dispatch('editDiskon', $diskonId)->to(ModalManagementDiskon::class);
    }

    public function deleteDiskon($diskonId)
    {
        $this->dispatch('hapusDiskon', $diskonId)->to(ModalManagementDiskon::class);
    }

    // Update status diskon
    public function updateStatusDiskon($diskonId, $status)
    {
        try {
            $diskon = Diskon::find($diskonId);
            $diskon->update(['is_active' => $status]);

            $this->dispatch('notificationAdmin', [
                'type' => 'success',
                'message' => 'Berhasil mengubah status diskon.',
                'title' => 'Sukses'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('notificationAdmin', [
                'type' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Error'
            ]);
        }
    }
    
    public function render()
    {
        return view('livewire.pages.admin.diskon.management-diskon', [
            'diskons' => Diskon::latest()->paginate(5),
        ]);
    }
}
