<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>

        <div class="inline-block align-button bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog">
            <form>
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="">
                        <div class="mb-4">
                            <label for="id_rak" class="block text-gray-700 text-sm font-bold mb-2">ID Rak:</label>
                            <input type="text" wire:model="id_rak" class="shadow appearance-none border rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="id_rak" name="id_rak" required>
                            @error('id_rak')
                            <span class="text-red-500">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="nama_rak" class="block text-gray-700 text-sm font-bold mb-2">Nama Rak:</label>
                            <input type="text" wire:model="nama_rak" class="shadow appearance-none border rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nama_rak" name="nama_rak" required>
                            @error('nama_rak')
                            <span class="text-red-500">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="lokasi_rak" class="block text-gray-700 text-sm font-bold mb-2">Lokasi Rak:</label>
                            <input type="text" wire:model="lokasi_rak" class="shadow appearance-none border rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="lokasi_rak" name="lokasi_rak" required>
                            @error('lokasi_rak')
                            <span class="text-red-500">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="id_buku" class="block text-gray-700 text-sm font-bold mb-2">Judul Buku:</label>
                            <select wire:model="id_buku" id="id_buku" name="id_buku" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option disable value>Pilih Buku</option>
                                @foreach($Buku as $bk)
                                    <option value="{{$bk->id_buku}}">{{$bk->judul_buku}}</option>
                                @endforeach
                            </select>
                            @error('id_buku')
                            <span class="text-red-500">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button wire:click="closeModal1()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:leading-5">
                            Cancel
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>