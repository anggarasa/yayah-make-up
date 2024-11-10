<div class="flex-1 p-8" x-data="{ previewImage: null }">
    <div class="bg-white rounded-lg shadow p-6 max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Detail Profile</h1>

        <!-- Profile Picture -->
        <div class="mb-6">
            <div class="flex items-center space-x-6">
                <div class="shrink-0">
                    <img class="h-32 w-32 object-cover rounded-full"
                        :src="previewImage || '/img/logo/logo-aplikasi-ym.svg'" alt="Profile picture">
                </div>
                <label class="block">
                    <span class="sr-only">Choose profile photo</span>
                    <input type="file" wire:model="profile"
                        class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-ungu-dark file:text-white hover:file:bg-purple-700"
                        @change="previewImage = URL.createObjectURL($event.target.files[0])">
                </label>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" wire:model="name"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-ungu-dark focus:ring-ungu-dark">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" wire:model="email"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-ungu-dark focus:ring-ungu-dark">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="tel" wire:model="phone"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-ungu-dark focus:ring-ungu-dark">
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea wire:model="alamat"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-ungu-dark focus:ring-ungu-dark"
                        rows="3"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                    <select wire:model="gender"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-ungu-dark focus:ring-ungu-dark">
                        <option value="">Pilih gender anda</option>
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                    <input type="date" wire:model="age"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-ungu-dark focus:ring-ungu-dark">
                </div>
            </div>
        </div>

        <div class="mt-6">
            <button
                class="w-full md:w-auto px-6 py-2 bg-ungu-dark text-white rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-ungu-dark focus:ring-offset-2">
                Simpan Perubahan
            </button>
        </div>
    </div>
</div>