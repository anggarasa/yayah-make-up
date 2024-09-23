<div>
    <div class=" max-w-3xl my-10 lg:mb-14">

        <h2 class="text-ungu-dark font-semibold font-poppins text-2xl md:text-4xl md:leading-tight">Category Product
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
                    Category
                </p>
                <i class="fa-solid fa-angle-right shrink-0 mx-2 size-4 text-gray-400"></i>
            </li>
            <li class="inline-flex items-center">
                <p class="flex items-center text-sm text-gray-500 cursor-pointer">
                    Product
                </p>
            </li>
        </ol>
    </div>

    <livewire:layout.admin.modals.category.modal-category-product />

    {{-- @if ($categories->count() > 0) --}}
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Card -->
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div
                        class="bg-white border border-ungu-dark rounded-xl shadow-sm overflow-hidden dark:bg-neutral-900 dark:border-neutral-700">
                        <!-- Header -->
                        <div
                            class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-ungu-dark">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                                    Category Product
                                </h2>
                                <p class="text-sm text-gray-600 dark:text-neutral-400">
                                    Daftar Kategori Product
                                </p>
                            </div>
                        </div>
                        <!-- End Header -->

                        <!-- Table -->
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead
                                class="bg-gray-50 divide-y divide-gray-200 dark:bg-neutral-800 dark:divide-neutral-700">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-start border-s border-gray-200 dark:border-neutral-700">
                                        <span
                                            class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                            Nama Category
                                        </span>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <span
                                            class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                            Slug Category
                                        </span>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-end"></th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                @foreach ($categories as $key => $category)
                                <tr>
                                    <td class="h-px w-auto whitespace-nowrap">
                                        <div class="px-6 py-2 flex items-center gap-x-3">
                                            <span class="text-sm text-gray-600 dark:text-neutral-400">{{ $key +
                                                $categories->firstItem() }}.</span>
                                            <span class="text-sm text-gray-800">
                                                {{ $category->name }}
                                            </span>
                                        </div>
                                    </td>

                                    <td class="h-px w-auto whitespace-nowrap">
                                        <div class="px-6 py-2">
                                            <span class="font-semibold text-sm text-gray-800">
                                                {{ $category->slug }}
                                            </span>
                                        </div>
                                    </td>

                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-1.5">
                                            {{-- Tombol Edit --}}
                                            <a wire:click="updateCategory({{ $category->id }})"
                                                class="inline-flex px-3 py-2 items-center mr-4 text-sm bg-ungu-dark text-white font-medium hover:bg-ungu-white rounded-lg cursor-pointer">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>

                                            {{-- Tombol Delete --}}
                                            <a class="inline-flex px-3 py-2 items-center gap-x-1 text-sm bg-red-600 text-white font-medium hover:bg-red-400 rounded-lg cursor-pointer"
                                                wire:click="konfirmDelete({{ $category->id }})">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table -->

                        <!-- Footer -->
                        <div
                            class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-ungu-dark dark:border-neutral-700">
                            {{ $categories->links() }}
                        </div>
                        <!-- End Footer -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->
    </div>
    {{-- @endif --}}
</div>