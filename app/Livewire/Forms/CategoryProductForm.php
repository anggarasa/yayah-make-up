<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Illuminate\Support\Str;
use App\Models\CategoryProduct;
use Livewire\Attributes\Validate;

class CategoryProductForm extends Form
{
    #[Validate('required|string|max:255')]
    public $name;

    #[Validate('required|unique:|max:255')]
    public $slug;

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function store()
    {

        CategoryProduct::create([
            'name' => $this->name,
           'slug' => $this->slug,
        ]);

        $this->reset(['name', 'slug']);
    }
}
