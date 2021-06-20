
<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>

        <div class="inline-block align-button bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog">
            <form >
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="">
                        <div class="mb-4">
                            <label for="kode_buku" class="block text-gray-700 text-sm font-bold mb-2">Kode Buku:</label>
                            <input type="text" wire:model="kode_buku" class="shadow appearance-none border rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="kode_buku" name="kode_buku" required>
                            @error('kode_buku')
                            <span class="text-red-500">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="judul_buku" class="block text-gray-700 text-sm font-bold mb-2">Judul Buku:</label>
                            <input type="text" wire:model="judul_buku" class="shadow appearance-none border rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="judul_buku" name="judul_buku" required>
                            @error('judul_buku')
                            <span class="text-red-500">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="penulis_buku" class="block text-gray-700 text-sm font-bold mb-2">Penulis Buku:</label>
                            <input type="text" wire:model="penulis_buku" class="shadow appearance-none border rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="penulis_buku" name="penulis_buku" required>
                            @error('penulis_buku')
                            <span class="text-red-500">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="penerbit_buku" class="block text-gray-700 text-sm font-bold mb-2">Penerbit:</label>
                            <input type="text" wire:model="penerbit_buku" class="shadow appearance-none border rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="penerbit_buku" name="penerbit_buku" required>
                            @error('penerbit_buku')
                            <span class="text-red-500">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="tahun_penerbit" class="block text-gray-700 text-sm font-bold mb-2">Tahun Terbit:</label>
                            <input type="text" wire:model="tahun_penerbit" class="shadow appearance-none border rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="tahun_penerbit" name="tahun_penerbit" required>
                            @error('tahun_penerbit')
                            <span class="text-red-500">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="stok" class="block text-gray-700 text-sm font-bold mb-2">Stok:</label>
                            <input type="number" wire:model="stok" class="shadow appearance-none border rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="stok" name="stok" required>
                            @error('stok')
                            <span class="text-red-500">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:leading-5">
                        save
                        </button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:leading-5">
                            Cancel
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>