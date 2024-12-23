<?php

namespace App\Livewire\Layout\Admin\Modals\Diskon;

use App\Models\Diskon;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;
use App\Livewire\Pages\Admin\Diskon\ManagementDiskon;

#[Layout('layouts.admin-layout')]
class ModalManagementDiskon extends Component
{
    public $code, $harga_diskon, $type, $start_date, $end_date;

    public $diskonId;
    public $is_edit = false;

    // Modal Edit Diskon
    #[On('editDiskon')]
    public function editDiskon($diskonId)
    {
        $this->resetInput();
        $this->diskonId = $diskonId;
        $diskon = Diskon::find($diskonId);
        $this->is_edit = true;
        $this->code = $diskon->code;
        $this->harga_diskon = $diskon->harga_diskon;
        $this->type = $diskon->type;
        $this->start_date = $diskon->start_date;
        $this->end_date = $diskon->end_date;
        $this->dispatch('modal-diskon');
    }

    // Modal Delete Diskon
    #[On('hapusDiskon')]
    public function hapusDiskon($diskonId)
    {
        $this->resetInput();
        $this->diskonId = $diskonId;
        $diskon = Diskon::find($diskonId);
        $this->code = $diskon->code;
        $this->dispatch('modal-confirmasi-diskon');
    }

    // Create Diskon
    public function createDiskon()
    {
        
        try {
            $this->validate([
                'code' => 'required|string|max:255|unique:diskons,code',
                'harga_diskon' => 'required|numeric',
                'type' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);

            // Cek apakah start_date sama dengan hari ini
            $today = now()->format('Y-m-d');
            $isToday = $this->start_date === $today;

            $isActive = $isToday ? true : false;

            // Create Diskon
            Diskon::create([
                'code' => $this->code,
                'harga_diskon' => $this->harga_diskon,
                'type' => $this->type,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'is_active' => $isActive,
            ]);

            $this->dispatch('create-diskon')->to(ManagementDiskon::class);
            $this->reset(['code', 'harga_diskon', 'type','start_date', 'end_date']);
            $this->dispatch('close-modal-diskon');

            $this->dispatch('notificationAdmin', [
                'type' => 'success',
                'message' => 'Diskon berhasil ditambahkan',
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

    // Update Diskon
    public function updateDiskon()
    {
        try {
            $this->validate([
                'code' => 'required|string|max:255|unique:diskons,code,' . $this->diskonId,
                'harga_diskon' => 'required|numeric',
                'type' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);

            // Cek apakah start_date sama dengan hari ini
            $today = now()->format('Y-m-d');
            $isToday = $this->start_date === $today;

            $isActive = $isToday ? true : false;

            // Update Diskon
            $diskon = Diskon::find($this->diskonId);
            $diskon->update([
                'code' => $this->code,
                'harga_diskon' => $this->harga_diskon,
                'type' => $this->type,
               'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'is_active' => $isActive
            ]);

            $this->dispatch('create-diskon')->to(ManagementDiskon::class);
            $this->resetInput();
            
            $this->dispatch('notificationAdmin', [
                'type' => 'success',
                'message' => 'Diskon berhasil diupdate',
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

    // Delete diskon
    public function deleteDiskon()
    {
        try {
            $diskon = Diskon::find($this->diskonId);
            $diskon->delete();

            $this->dispatch('create-diskon')->to(ManagementDiskon::class);
            $this->resetInput();
            
            $this->dispatch('notificationAdmin', [
                'type' => 'success',
                'message' => 'Diskon berhasil dihapus!',
                'title' => 'Sukses'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('notificationAdmin', [
                'type' => 'error',
                'message' => $e->getMessage(),
                'title' => "Error"
            ]);
        }
    }

    public function render()
    {
        return view('livewire.layout.admin.modals.diskon.modal-management-diskon');
    }

    // Message validation
    protected $messages = [
        'code.required' => 'Code diskon wajib diisi.',
        'code.unique' => 'Code diskon sudah ada, silakan buat code lain.',
        'type.required' => 'Pilih type diskon wajib diisi.',
        'harga_diskon.required' => 'Total diskon wajib diisi.',
        'start_date.required' => 'Tanggal mulai wajib diisi.',
        'end_date.required' => 'Tanggal berakhir wajib diisi.',
        'start_date.date' => 'Tanggal mulai harus berupa tanggal.',
        'end_date.date' => 'Tanggal berakhir harus berupa tanggal.',
        'end_date.after_or_equal:start_date' => 'Tanggal berakhir harus setelah tanggal mulai.',
    ];

    public function resetInput()
    {
        $this->reset(['code', 'harga_diskon', 'type','start_date', 'end_date', 'diskonId']);
        $this->is_edit = false;
        $this->dispatch('close-modal-diskon');
        $this->dispatch('close-modal-confirmasi-diskon');
    }

    // Close modal
}
