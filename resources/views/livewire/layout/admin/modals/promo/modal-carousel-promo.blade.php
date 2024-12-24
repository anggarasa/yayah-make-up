<div>
    <div x-data="{
        showModal: false,
        color: '',
        imagePreview: null,
        previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => this.imagePreview = e.target.result;
                reader.readAsDataURL(file);
            }
        },
        clearForm() {
            this.color = '';
            this.imagePreview = null;
        }
    }">
        <!-- Trigger Button -->
        <button type="button" @click="$dispatch('modal-promo-carousel')"
            class="bg-ungu-dark hover:bg-ungu-white text-white font-semibold px-4 py-2 rounded-lg shadow-md transition duration-300">
            <i class="fa-solid fa-plus shrink-0 text-base"></i>
            Add Promo
        </button>

        <!-- Modal -->
        <div x-show="showModal" @modal-promo-carousel.window="showModal = true"
            @close-modal-promo-carousel.window="showModal = false"
            class="fixed inset-0 z-50 flex items-center justify-center modal-backdrop"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto mx-4">
                <!-- Modal Header -->
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-2xl font-semibold text-gray-800">Add Promo</h3>
                </div>

                <form wire:submit="create">
                    <!-- Modal Body -->
                    <div class="p-6 space-y-6">
                        <!-- Title Input -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                            <input type="text" wire:model="title"
                                class="w-full px-4 py-2 border border-black rounded-lg focus:ring-2 focus:ring-ungu-dark focus:border-ungu-dark transition duration-200" />
                        </div>

                        <!-- Description Input -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea wire:model="description" rows="4"
                                class="w-full px-4 py-2 border border-black rounded-lg focus:ring-2 focus:ring-ungu-dark focus:border-ungu-dark transition duration-200"></textarea>
                        </div>

                        <!-- Image Upload -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                            <div class="space-y-4">
                                <input type="file" wire:model="image" @change="previewImage" accept="image/*"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-ungu-tipis file:text-ungu-dark hover:file:bg-blue-100" />

                                <div x-show="imagePreview" class="mt-2">
                                    <img :src="imagePreview" class="max-w-xs rounded-lg shadow-md" />
                                </div>
                            </div>
                        </div>

                        <!-- Link Input -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Link</label>
                            <input type="url" wire:model="link"
                                class="w-full px-4 py-2 border border-black rounded-lg focus:ring-2 focus:ring-ungu-dark focus:border-ungu-dark transition duration-200" />
                        </div>

                        <!-- Color Select -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Color</label>
                            <select x-model="color" wire:model="color"
                                class="w-full px-4 py-2 border border-black rounded-lg focus:ring-2 focus:ring-ungu-dark focus:border-ungu-dark transition duration-200">
                                <option value="">Select color</option>
                                <option value="red">
                                    <span class="color-preview" style="background: #e02424"></span>Red
                                </option>
                                <option value="orange">
                                    <span class="color-preview" style="background: #d03801"></span>Orange
                                </option>
                                <option value="blue">
                                    <span class="color-preview" style="background: #1c64f2"></span>Blue
                                </option>
                                <option value="teal">
                                    <span class="color-preview" style="background: #047481"></span>Teal
                                </option>
                                <option value="green">
                                    <span class="color-preview" style="background: #057a55"></span>Green
                                </option>
                                <option value="yellow">
                                    <span class="color-preview" style="background: #9f580a"></span>Yellow
                                </option>
                                <option value="indigo">
                                    <span class="color-preview" style="background: #5850ec"></span>Indigo
                                </option>
                                <option value="purple">
                                    <span class="color-preview" style="background: #7e3af2"></span>Purple
                                </option>
                                <option value="pink">
                                    <span class="color-preview" style="background: #d61f69"></span>Pink
                                </option>
                                <option value="gray">
                                    <span class="color-preview" style="background: #4b5563"></span>Gray
                                </option>
                            </select>

                            <!-- Color Preview -->
                            <div x-show="color" class="mt-2 p-2 rounded-lg border border-gray-200">
                                <div class="flex items-center">
                                    <div class="w-6 h-6 rounded" :style="`background-color: ${color}`"></div>
                                    <span class="ml-2 text-sm text-gray-600">Selected color preview</span>
                                </div>
                            </div>
                        </div>

                        <!-- Button Text Input -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Button Text</label>
                            <input type="text" wire:model="text_button"
                                class="w-full px-4 py-2 border border-black rounded-lg focus:ring-2 focus:ring-ungu-dark focus:border-ungu-dark transition duration-200" />
                        </div>

                        <!-- Date Inputs -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                                <input type="date" wire:model="start_date"
                                    class="w-full px-4 py-2 border border-black rounded-lg focus:ring-2 focus:ring-ungu-dark focus:border-ungu-dark transition duration-200" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                                <input type="date" wire:model="end_date"
                                    class="w-full px-4 py-2 border border-black rounded-lg focus:ring-2 focus:ring-ungu-dark focus:border-ungu-dark transition duration-200" />
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                        <button wire:click="resetInput" @click="clearForm()" class=" px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg transition
                        duration-200">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-ungu-dark hover:bg-ungu-white text-white rounded-lg transition duration-200">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>