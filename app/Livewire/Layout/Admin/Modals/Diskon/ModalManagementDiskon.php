<?php

namespace App\Livewire\Layout\Admin\Modals\Diskon;

use App\Livewire\Pages\Admin\Diskon\ManagementDiskon;
use App\Models\Diskon;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

#[Layout('layouts.admin-layout')]
class ModalManagementDiskon extends Component
{
    #[Validate('required|string|max:255|unique:diskons,code')]
    public $code;

    #[Validate('required|numeric')]
    public $harga_diskon;

    #[Validate('required')]
    public $type;

    #[Validate('required|date')]
    public $start_date;

    #[Validate('required|date|after_or_equal:start_date')]
    public $end_date;

    // Modal success & error messages
    public $judul, $message;

    // Create Diskon
    public function createDiskon()
    {
        
        try {
            $this->validate();
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
}
