<?php

namespace App\Livewire\Layout\Admin\Modals\Promo;

use Livewire\Component;
use App\Models\PromoCarousel;
use Livewire\Attributes\Layout;
use App\Livewire\Pages\Admin\Promo\CarouselPromo;
use Livewire\WithFileUploads;

#[Layout('layouts.admin-layout')]
class ModalCarouselPromo extends Component
{
    use WithFileUploads;
    
    public $title, $description, $image, $link, $color, $text_button, $start_date, $end_date;

    public $is_edit = false;
    public $promoId;

    // Create Promo
    public function create()
    {
        try {
            $this->validate([
                'title' => 'required|string|max:255',
                'description' => 'required',
                'image' => 'required|image|mimes:png,jpg,jpeg|max:2000',
                'link' => 'required|url',
                'color' => 'required|string',
                'text_button' => 'required|string|max:255',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);

            // Cek apakah start date sama dengan harin ini
            $today = now()->format('Y-m-d');
            $isToday = $this->start_date === $today;

            $isActive = $isToday? true : false;

            // Create Promo
            PromoCarousel::create([
                'title' => $this->title,
                'description' => $this->description,
                'image' => $this->image->store('promo/promo-carousel', 'public'),
                'link' => $this->link,
                'color_button' => $this->color,
                'text_button' => $this->text_button,
               'start_date' => $this->start_date,
               'end_date' => $this->end_date,
                'is_active' => $isActive,
            ]);

            $this->dispatch('create-promo-carousel')->to(CarouselPromo::class);
            $this->resetInput();

            $this->dispatch('notificationAdmin', [
                'type' => 'success',
                'message' => 'Promo berhasil ditambahkan',
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
        return view('livewire.layout.admin.modals.promo.modal-carousel-promo');
    }

    // Error message handler
    protected $messages = [
        'title.required' => 'Judul wajib diisi.',
        'title.max' => 'Judul maksimal 255 karakter.',
        'description.required' => 'Deskripsi wajib diisi.',
        'image.required' => 'Gambar wajib diisi.',
        'image.max' => "Gambar maksimal 2MB.",
        'image.mimes' => 'Format gambar harus PNG, JPG, atau JPEG.',
        'link.url' => 'Link harus valid.',
        'link.required' => 'Link wajib diisi.',
        'color.required' => 'Warna wajib diisi.',
        'text_button.required' => 'Teks tombol wajib diisi.',
        'start_date.required' => 'Tanggal mulai wajib diisi.',
        'end_date.required' => 'Tanggal berakhir wajib diisi.',
        'end_date.after_or_equal' => 'Tanggal berakhir harus setelah atau sama dengan tanggal mulai.',
    ];

    public function resetInput()
    {
        $this->reset(['title', 'description', 'image', 'link', 'color', 'text_button','start_date', 'end_date', 'promoId']);
        $this->is_edit = false;
        
        $this->dispatch('close-modal-promo-carousel');
    }
}
