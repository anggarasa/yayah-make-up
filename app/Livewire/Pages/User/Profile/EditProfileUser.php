<?php

namespace App\Livewire\Pages\User\Profile;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.profile-user-layout')]
class EditProfileUser extends Component
{
    public $user;

    public $name, $email, $phone, $alamat, $gender, $age, $profile;

    public function mount($name)
    {
        $this->user = User::where('name', $name)->firstOrFail();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone_number;
        $this->alamat = $this->user->alamat;
        $this->gender = $this->user->gender;
        $this->age = $this->user->age;
        $this->profile = $this->user->profile;
    }

    protected $rules = [
        'name' => ['required','string','min:3','max:255'],
        'email' => ['required','email:rfc,dns,strict','unique:users,email'],
        'phone' => ['required','numeric','unique:users,phone_number', 'min:10', 'max:13'],
        'alamat' => ['required','string','min:5','max:191'],
        'gender' => ['required','in:laki-laki,perempuan'],
        'age' => ['required'],
        'profile' => ['image','nullable','mimes:jpeg,png,jpg','max:2048']
    ];

    public function updateProfile()
    {
        
    }
    
    public function render()
    {
        return view('livewire.pages.user.profile.edit-profile-user');
    }
}
