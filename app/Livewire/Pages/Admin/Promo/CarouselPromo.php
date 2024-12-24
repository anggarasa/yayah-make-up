<?php

namespace App\Livewire\Pages\Admin\Promo;

use App\Models\PromoCarousel;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.admin-layout')]
#[On('create-promo-carousel')]
class CarouselPromo extends Component
{
    public function render()
    {
        return view('livewire.pages.admin.promo.carousel-promo', [
            'promos' => PromoCarousel::latest()->get()
        ]);
    }
}
