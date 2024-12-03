<?php

namespace App\Livewire\Pages\User\Profile;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

#[Layout('layouts.profile-user-layout')]
class EditProfileUser extends Component
{
    use WithFileUploads;
    
    public $user;

    public $name, $username, $email, $phone, $alamat, $gender, $age, $profile;

    public $judul, $message;

    public function mount($username)
    {
        $this->user = User::where('username', $username)->firstOrFail();
        $this->name = $this->user->name;
        $this->username = $this->user->username;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone_number;
        $this->alamat = $this->user->alamat;
        $this->gender = $this->user->gender;
        $this->age = $this->user->age;
        $this->profile = $this->user->profile;
    }

    protected $rules = [
        'name' => ['required', 'string', 'min:3', 'max:255'],
        'username' => ['required', 'string', 'min:3', 'max:255'],
        'email' => ['required', 'email:rfc,dns,strict'],
        'phone' => ['required', 'numeric', 'digits_between:10,13'],
        'alamat' => ['required', 'string', 'min:5', 'max:191'],
        'gender' => ['required', 'in:laki-laki,perempuan'],
        'age' => ['required', 'date'],
        'profile' => ['image', 'nullable', 'mimes:jpeg,png,jpg', 'max:2048']
    ];
    
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, $this->customRules());
    }
    
    private function customRules()
    {
        return [
            'username' => ['required', 'string', 'min:3', 'max:255', 'unique:users,username,' . $this->user->id],
            'email' => ['required', 'email:rfc,dns,strict', 'unique:users,email,' . $this->user->id],
            'phone' => ['required', 'numeric', 'digits_between:10,13', 'unique:users,phone_number,' . $this->user->id],
        ];
    }
    
    public function updateProfile()
    {
        $this->validate($this->customRules());
    
        try {
            // Update data pengguna
            $this->user->update([
                'name' => $this->name,
                'username' => $this->username,
                'email' => $this->email,
                'phone_number' => $this->phone,
                'alamat' => $this->alamat,
                'gender' => $this->gender,
                'age' => $this->age,
            ]);
    
            // Update foto profil jika ada
            if ($this->profile) {
                // Pastikan $this->profile adalah objek file (instance dari UploadedFile)
                if ($this->profile instanceof \Illuminate\Http\UploadedFile) {
                    // Jika profile sebelumnya null, simpan profile baru
                    if ($this->user->profile === null) {
                        $imageName = time() . '.' . $this->profile->getClientOriginalExtension();
                        $this->profile->storeAs('uploads/profile', $imageName);
                        $this->user->update(['profile' => $imageName]);
                    } else {
                        // Jika profile sudah ada sebelumnya
                        $oldProfile = $this->user->profile;
                        $oldProfilePath = public_path('storage/uploads/profile/' . $oldProfile);
                        
                        // Hapus file profile lama
                        if (file_exists($oldProfilePath)) {
                            unlink($oldProfilePath);
                        }
                        
                        // Simpan profile baru
                        $imageName = time() . '.' . $this->profile->getClientOriginalExtension();
                        $this->profile->storeAs('uploads/profile', $imageName);
                        $this->user->update(['profile' => $imageName]);
                    }
                }
            }
    
            $this->judul = "Success";
            $this->message = "Profile berhasil diubah";

            // Dispatch untuk menampilkan modal
            $this->dispatch('profile-success');

            // Redirect setelah 3 detik
            $this->dispatch('redirectAfterDelay', route('profile-user', $this->user->username));
        } catch (\Exception $e) {
            $this->judul = 'Error';
            $this->message = $e->getMessage();
            $this->dispatch('profile-error');
        }
    }    
    
    public function render()
    {
        return view('livewire.pages.user.profile.edit-profile-user');
    }
}
