<div>
    <div class="flex flex-col min-h-screen bg-black/60">
        <div class="container flex flex-col flex-1 px-4 sm:px-6 py-8 sm:py-12 mx-auto">
            <div class="flex-1 lg:flex lg:items-center lg:-mx-6">
                <!-- Bagian Kiri - Informasi Kontak -->
                <div class="text-white lg:w-1/2 lg:mx-6">
                    <h1
                        class="text-2xl text-center sm:text-left sm:ml-0 lg:ml-20 font-semibold font-poppins capitalize lg:text-4xl">
                        Butuh Konsultasi..?<br />Silakan Kontak Kami<br>Kami Siap Membantu
                    </h1>

                    <div class="flex flex-col sm:flex-row items-start sm:items-center sm:ml-0 lg:ml-20 mt-6">
                        <h3 class="text-xl font-extrabold mb-2 sm:mb-0">Alamat:</h3>
                        <p class="max-w-xl sm:mt-0 sm:ml-4 text-sm sm:text-base">
                            jl. kp. epres no.1 Rt/Rw 18/07 Ds, Jatiragas Hilir, Kec. Patokbeusi, Kabupaten Subang,
                            Jawa Barat 41263
                        </p>
                    </div>

                    <div class="mt-8 sm:mt-14 text-center sm:text-left sm:ml-0 lg:ml-20">
                        <a href="mailto:YayahMakeup@gmail.com" class="text-base sm:text-lg font-semibold block mb-3">
                            <i class="fa-solid fa-envelope mr-2"></i>YayahMakeup@gmail.com
                        </a>
                        <a href="tel:+6285864130067" class="text-base sm:text-lg font-semibold block">
                            <i class="fa-solid fa-phone mr-2"></i>+62 858-6413-0067
                        </a>
                    </div>

                    <div class="mt-8 sm:mt-14 text-center sm:text-left sm:ml-0 lg:ml-20">
                        <h3 class="text-white text-xl font-bold mb-4">Sosial Media</h3>

                        <div class="flex justify-center sm:justify-start space-x-6">
                            <a class="text-white transition-colors duration-300 transform hover:text-ungu-dark"
                                href="#">
                                <i class="fa-brands fa-facebook text-2xl sm:text-3xl"></i>
                            </a>

                            <a class="text-white transition-colors duration-300 transform hover:text-ungu-dark"
                                href="https://www.instagram.com/yayah.makeup/">
                                <i class="fa-brands fa-instagram text-2xl sm:text-3xl"></i>
                            </a>

                            <a class="text-white transition-colors duration-300 transform hover:text-ungu-dark"
                                href="#">
                                <i class="fa-brands fa-tiktok text-2xl sm:text-3xl"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Bagian Kanan - Form -->
                <div class="mt-12 lg:mt-8 lg:w-1/2 lg:mx-6">
                    <div
                        class="w-full px-6 sm:px-8 py-8 sm:py-10 mx-auto overflow-hidden bg-white shadow-2xl rounded-xl dark:bg-gray-900 lg:max-w-xl">
                        <h1 class="text-2xl sm:text-3xl font-extrabold font-poppins text-ungu-dark text-center">
                            Ada Pertanyaan..?
                        </h1>

                        <p class="mt-2 text-sm sm:text-base text-gray-500 text-center">
                            Silakan isi form ini jika anda ingin menanyakan sesuatu.
                        </p>

                        <form wire:submit="submit" class="mt-6">
                            <div class="flex-1">
                                <x-input-label for="name" :value="__('Nama Lengkap')" />
                                <x-text-input type="text" wire:model="name" id="name" placeholder="Your name"
                                    class="block w-full mt-1" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div class="flex-1 mt-6">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input type="email" id="email" wire:model="email"
                                    placeholder="youremail@example.com" class="block w-full mt-1" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="w-full mt-6">
                                <x-input-label for="question" :value="__('Pertanyaan')" />
                                <textarea id="question" wire:model="question"
                                    class="block w-full h-32 px-4 sm:px-5 py-2.5 sm:py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-black rounded-md md:h-48 focus:border-ungu-dark focus:ring-ungu-dark focus:ring-opacity-40 focus:outline-none focus:ring"
                                    placeholder="Message"></textarea>
                                <x-input-error :messages="$errors->get('question')" class="mt-2" />
                            </div>

                            <button type="submit"
                                class="w-full px-6 py-3 mt-6 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-ungu-dark rounded-md hover:bg-ungu-white hover:text-ungu-dark">
                                Kirim
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal notifikasi --}}
    @include('welcome.modals.modal-contact-welcome-notifikasi')
    {{-- modal notifikasi --}}
</div>