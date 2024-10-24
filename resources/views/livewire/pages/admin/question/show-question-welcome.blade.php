<div>
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <a href="{{ route('list-question') }}" wire:navigate
                class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>

        <div class="border border-gray-200 p-6 rounded-lg shadow-md bg-white">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Detail Pertanyaan</h2>
            <div class="space-y-2 text-gray-700">
                <p><strong>Nama:</strong> {{ $question->name }}</p>
                <p><strong>Email:</strong> {{ $question->email }}</p>
                <p><strong>Pertanyaan:</strong> {{ $question->question }}</p>
            </div>
        </div>

        @if(!$question->is_answer)
        <div class="border border-gray-200 p-6 rounded-lg shadow-md bg-white">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Jawab Pertanyaan</h3>
            <form wire:submit.prevent="submitAnswer">
                <div>
                    <textarea wire:model="answer"
                        class="w-full p-3 border border-black rounded-md focus:outline-none focus:ring-ungu-dark focus:border-ungu-dark"
                        rows="4"></textarea>
                    @error('answer')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <x-primary-button class="mt-4">
                    Kirim Jawaban
                </x-primary-button>
            </form>
        </div>
        @else
        <div class="border border-gray-200 p-6 rounded-lg shadow-md bg-white">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Jawaban</h3>
            <p class="text-gray-700">{{ $question->answer }}</p>
        </div>
        @endif
    </div>

    {{-- Modal notifikasi contact welcome --}}
    @include('welcome.modals.modal-contact-welcome-notifikasi')
    {{-- Modal notifikasi contact welcome --}}
</div>