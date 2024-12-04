<?php

namespace App\Livewire\Layout\Admin\Modals\Diskon;

use App\Livewire\Pages\Admin\Diskon\ManagementDiskon;
use App\Models\Diskon;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;

#[Layout('layouts.admin-layout')]
class ModalManagementDiskon extends Component
{
    public $code, $harga_diskon, $type, $start_date, $end_date;

    public $diskonId;
    public $is_edit = false;

    // Modal success & error messages
    public $judul, $message;

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
            // Create Diskon
            Diskon::create([
                'code' => $this->code,
                'harga_diskon' => $this->harga_diskon,
                'type' => $this->type,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ]);

            $this->dispatch('create-diskon')->to(ManagementDiskon::class);
            $this->reset(['code', 'harga_diskon', 'type','start_date', 'end_date']);
            $this->dispatch('close-modal-diskon');
            
            $this->judul = 'Suceess';
            $this->message = 'Diskon berhasil ditambahkan';
            $this->dispatch('diskon-success');
        } catch (\Exception $e) {
            $this->judul = 'Error';
            $this->message = $e->getMessage();
            $this->dispatch('diskon-error');
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
            // Update Diskon
            $diskon = Diskon::find($this->diskonId);
            $diskon->update([
                'code' => $this->code,
                'harga_diskon' => $this->harga_diskon,
                'type' => $this->type,
               'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ]);

            $this->dispatch('create-diskon')->to(ManagementDiskon::class);
            $this->resetInput();
            
            $this->judul = 'Suceess';
            $this->message = 'Diskon berhasil diupdate';
            $this->dispatch('diskon-success');
        } catch (\Exception $e) {
            $this->judul = 'Error';
            $this->message = $e->getMessage();
            $this->dispatch('diskon-error');
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
            
            $this->judul = 'Suceess';
            $this->message = 'Diskon berhasil dihapus!';
            $this->dispatch('diskon-success');
        } catch (\Exception $e) {
            $this->judul = "Error";
            $this->message = $e->getMessage();
            $this->dispatch('diskon-error');
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
