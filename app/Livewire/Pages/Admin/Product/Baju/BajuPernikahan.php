<?php

namespace App\Livewire\Pages\Admin\Product\Baju;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;
use App\Models\BajuPernikahan as ModelsBajuPernikahan;
use Livewire\Features\SupportPagination\WithoutUrlPagination;

#[Layout('layouts.admin-layout')]
class BajuPernikahan extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $judul, $message;

    public $name, $image_dress;
    public $dressId;

    public function confirmDelete($id)
    {
        $this->dressId = $id;
        $baju = ModelsBajuPernikahan::find($id);
        $this->name = $baju->name;
        $this->image_dress = $baju->image_dress;

        $this->judul = 'Yakin?';
        $this->message = 'Apakah anda yakin ingin menghapus baju ini?';
        $this->dispatch('modal-confirm-delete');
    }

    public function deleteDress()
    {
        try {
            // Hapus gambar jika ada
            if ($this->image_dress && Storage::disk('public')->exists('file-dress/'.$this->image_dress)) {
                Storage::disk('public')->delete('file-dress/'.$this->image_dress);
            }

            // Hapus dress dari database
            ModelsBajuPernikahan::findOrFail($this->dressId)->delete();

            $this->dispatch('close-modal-confirm-delete');
            $this->reset();
            $this->judul = 'Success';
            $this->message = 'Baju berhasil dihapus!';
            $this->dispatch('dress-success');
        } catch (\Exception $e) {
            $this->judul = "Error";
            $this->message = $e->getMessage();
            $this->dispatch('dress-error');
        }
    }

    public function resetInput()
    {
        $this->reset();
        $this->dispatch('close-modal-confirm-delete');
    }
    
    public function render()
    {
        return view('livewire.pages.admin.product.baju.baju-pernikahan', [
            'dresses' => ModelsBajuPernikahan::latest()->paginate(6)
        ]);
    }
}
