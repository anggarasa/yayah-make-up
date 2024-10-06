<?php

namespace App\Livewire\Pages\Admin\Crud\Baju;

use App\Livewire\Pages\Admin\Product\Baju\BajuPernikahan as BajuBajuPernikahan;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\BajuPernikahan;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.admin-layout')]
class CrudBajuPernikahan extends Component
{
    use WithFileUploads;
    
    #[Validate('nullable|image|mimes:png,jpg,jpeg|max:2000')]
    public $image_dress;

    #[Validate('required|string|max:255')]
    public $name;

    #[Validate('required')]
    public $dress_type;

    public $dressId, $oldImage;
    public $judul, $message;

    public function mount($id = null)
    {
        if($id) {
            $this->dressId = $id;
            $dress = BajuPernikahan::find($id);
            $this->name = $dress->name;
            $this->dress_type = $dress->dress_type;
            $this->oldImage = $dress->image_dress;
        }
    }

    public function saveDress()
    {
        try {
            $this->validate();
            if ($this->dressId) {
                $dress = BajuPernikahan::find($this->dressId);
                if ($this->image_dress) {
                    // Delete old image
                    if ($this->oldImage && Storage::disk('public')->exists('file-dress/'.$this->oldImage)) {
                        Storage::disk('public')->delete('file-dress/'.$this->oldImage);
                    }
                    
                    // Save new image
                    $imageName = time().'.'.$this->image_dress->getClientOriginalExtension();
                    $this->image_dress->storeAs('file-dress', $imageName, 'public');
                    
                    // Update with new image
                    $dress->update([
                        'image_dress' => $imageName,
                        'name' => $this->name,
                        'dress_type' => $this->dress_type,
                    ]);
                } else {
                    // Update without changing image
                    $dress->update([
                        'name' => $this->name,
                        'dress_type' => $this->dress_type,
                    ]);
                }

                $this->reset();

                $this->judul = 'Success!';
                $this->message = 'Berhasil mengupdate baju pernikahan';
                $this->dispatch('dress-success');
            } else {
                $imageName = time().'.'.$this->image_dress->getClientOriginalExtension();
                $this->image_dress->storeAs('file-dress', $imageName, 'public');
                
                BajuPernikahan::create([
                    'image_dress' => $imageName,
                    'name' => $this->name,
                    'dress_type' => $this->dress_type,
                ]);

                $this->reset();
                $this->judul = 'Success!';
                $this->message = 'Berhasil menambahkan baju pernikahan';
                $this->dispatch('dress-success');
            }
        } catch (\Exception $e) {
            $this->judul = 'Error';
            $this->message = $e->getMessage();
            $this->dispatch('dress-error');
        }
    }

    public function resetInput()
    {
        $this->reset();
        $this->redirect(route('baju-pernikahan'), navigate: true);
    }


    protected $messages = [
        'image_dress.mimes' => 'Gambar harus bertype PNG, JPG, dan JPEG. Tidak boleh yang lain',
        'image_dress.max' => 'Gambar tidak boleh lebih dari 2mb',
        'name.required' => 'Nama Dress wajib di isi',
        'name.max' => 'Nama Dres tidak boleh lebih dari 225 karakter',
        'dress_type.required' => 'Dress wajib memiliki katagory',
    ];
    
    public function render()
    {
        return view('livewire.pages.admin.crud.baju.crud-baju-pernikahan');
    }
}
