<div>
    <!-- Filter Section -->
    <div class="mb-6 bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4 text-gray-800">Filter Pertanyaan</h3>
        <div class="flex space-x-4">
            <button wire:click="$set('statusFilter', 'all')"
                class="px-4 py-2 rounded-md font-medium transition {{ $statusFilter === 'all' ? 'bg-ungu-dark text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}">
                Semua ({{ $totalCount }})
            </button>
            <button wire:click="$set('statusFilter', 'answered')"
                class="px-4 py-2 rounded-md font-medium transition {{ $statusFilter === 'answered' ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}">
                Sudah Dijawab ({{ $answeredCount }})
            </button>
            <button wire:click="$set('statusFilter', 'unanswered')"
                class="px-4 py-2 rounded-md font-medium transition {{ $statusFilter === 'unanswered' ? 'bg-yellow-600 text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}">
                Belum Dijawab ({{ $unansweredCount }})
            </button>
        </div>
    </div>

    <!-- Questions List -->
    <div class="space-y-4" wire:poll>
        @if($questions->isEmpty())
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <p class="text-gray-500">Tidak ada pertanyaan yang ditemukan.</p>
        </div>
        @else
        @foreach($questions as $question)
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-2">
                <h3 class="font-semibold text-gray-800">{{ $question->name }}</h3>
                <span
                    class="px-3 py-1 rounded-full text-sm {{ $question->is_answer ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                    {{ $question->is_answer ? 'Sudah Dijawab' : 'Belum Dijawab' }}
                </span>
            </div>
            <p class="text-gray-600 mb-3">{{ Str::limit($question->question, 100) }}</p>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-500">
                    {{ $question->created_at->diffForHumans() }}
                </span>
                <a href="{{ route('show-question', $question) }}" wire:navigate
                    class="px-4 py-2 bg-ungu-dark text-white rounded-md hover:bg-ungu-white transition">
                    Lihat Detail
                </a>
            </div>
        </div>
        @endforeach
        @endif
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $questions->links() }}
    </div>
</div>