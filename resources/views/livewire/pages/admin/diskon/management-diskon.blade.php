<div>
    <div class=" max-w-3xl my-10 lg:mb-6">

        <h2 class="text-ungu-dark font-semibold font-poppins text-2xl md:text-4xl md:leading-tight">Diskon List
        </h2>

        <ol class="flex mt-5 items-center whitespace-nowrap">
            <li class="inline-flex items-center">
                <a class="flex items-center text-sm text-ungu-dark hover:text-ungu-white focus:outline-none focus:text-ungu-dark"
                    href="{{ route('dashboard-admin') }}" wire:navigate>
                    Dashboard
                </a>
                <i class="fa-solid fa-angle-right shrink-0 mx-2 size-4 text-gray-400"></i>
            </li>
            <li class="inline-flex items-center">
                <p class="flex items-center text-sm text-gray-500 cursor-pointer">
                    Diskon & Promo
                </p>
                <i class="fa-solid fa-angle-right shrink-0 mx-2 size-4 text-gray-400"></i>
            </li>
            <li class="inline-flex items-center">
                <p class="flex items-center text-sm text-gray-500 cursor-pointer">
                    Diskon
                </p>
            </li>
        </ol>
    </div>



    <!-- Table Section -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Card -->
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div
                        class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden dark:bg-neutral-800 dark:border-neutral-700">
                        <!-- Header -->
                        <div
                            class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                                    Management Diskon
                                </h2>
                                <p class="text-sm text-gray-600 dark:text-neutral-400">
                                    Tambah diskon, edit diskon, dan hapus diskon.
                                </p>
                            </div>

                            <div>
                                <livewire:layout.admin.modals.diskon.modal-management-diskon>
                            </div>
                        </div>
                        <!-- End Header -->

                        <!-- Table -->
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead class="bg-gray-50 dark:bg-neutral-800">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                Code
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                Total
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                Type
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                Start Date
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                End Date
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                Active
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-end"></th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @foreach ($diskons as $diskon)
                                <tr>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span
                                                class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{
                                                $diskon->code }}</span>
                                        </div>
                                    </td>
                                    <td class="h-px w-72 whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span
                                                class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                                @if ($diskon->type == 'fixed')
                                                Rp {{ number_format($diskon->harga_diskon, 0, ',', '.') }}
                                                @else
                                                {{ number_format($diskon->harga_diskon, 0, ',', '.') }}%
                                                @endif
                                            </span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span
                                                class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium rounded-full {{ $diskon->type == 'fixed' ? 'bg-blue-100 text-blue-800' : 'bg-orange-100 text-orange-800' }}">
                                                @if ($diskon->type == 'fixed')
                                                Tetap
                                                @else
                                                Persen
                                                @endif
                                            </span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="text-sm text-gray-500 dark:text-neutral-500">
                                                {{ \Carbon\Carbon::parse($diskon->start_date)->format('F j, Y') }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="text-sm text-gray-500 dark:text-neutral-500">
                                                {{ \Carbon\Carbon::parse($diskon->end_date)->format('F j, Y') }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap" x-data="{ dropdownOpen: false }">
                                        <div class="px-6 py-3">
                                            <span @click="dropdownOpen = !dropdownOpen"
                                                class="py-1 px-1.5 inline-flex cursor-pointer items-center gap-x-1 text-xs font-medium {{ $diskon->is_active ? 'bg-teal-100 text-teal-800' : 'bg-red-100 text-red-800' }} rounded-full hover:underline">
                                                @if ($diskon->is_active)
                                                <i class="fa-solid fa-circle-check text-[10px]"></i>
                                                Active
                                                @else
                                                <i class="fa-solid fa-x text-[10px]"></i>
                                                Tidak Active
                                                @endif
                                            </span>
                                        </div>

                                        <div x-show="dropdownOpen" @click.outside="dropdownOpen = false"
                                            class="z-10 absolute bg-gray-200 divide-y divide-gray-100 rounded-lg shadow w-44"
                                            style="display: none;">
                                            <ul class="py-2 text-sm text-gray-900">
                                                <li>
                                                    <a href="#"
                                                        @click="dropdownOpen = false; $wire.updateStatusDiskon({{ $diskon->id }}, true)"
                                                        class="block px-4 py-2 hover:bg-gray-300">Active</a>
                                                </li>
                                                <li>
                                                    <a href="#"
                                                        @click="dropdownOpen = false; $wire.updateStatusDiskon({{ $diskon->id }}, false)"
                                                        class="block px-4 py-2 hover:bg-gray-300">Tidak Active</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-1.5 space-x-4">
                                            <button type="button" wire:click="editDiskon({{ $diskon->id }})"
                                                class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium">
                                                Edit
                                            </button>
                                            <button type="button" wire:click="deleteDiskon({{ $diskon->id }})"
                                                class="inline-flex items-center gap-x-1 text-sm text-red-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium">
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table -->

                        <!-- Footer -->
                        <div
                            class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-neutral-700">
                            {{ $diskons->links() }}
                        </div>
                        <!-- End Footer -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->
    </div>
    <!-- End Table Section -->
</div>