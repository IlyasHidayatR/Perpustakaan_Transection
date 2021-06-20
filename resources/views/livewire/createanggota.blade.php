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
                            <label for="kode_anggota" class="block text-gray-700 text-sm font-bold mb-2">Kode Anggota:</label>
                            <input type="text" wire:model="kode_anggota" class="shadow appearance-none border rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="kode_anggota" name="kode_anggota" required>
                            @error('kode_anggota')
                            <span class="text-red-500">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="nama_anggota" class="block text-gray-700 text-sm font-bold mb-2">Nama Anggota:</label>
                            <input type="text" wire:model="nama_anggota" class="shadow appearance-none border rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nama_anggota" name="nama_anggota" required>
                            @error('nama_anggota')
                            <span class="text-red-500">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="jk_anggota" class="block text-gray-700 text-sm font-bold mb-2">Jenis Kelamin:</label>
                            <input type="text" wire:model="jk_anggota" class="shadow appearance-none border rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="jk_anggota" name="jk_anggota" required>
                            @error('jk_anggota')
                            <span class="text-red-500">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="jurusan_anggota" class="block text-gray-700 text-sm font-bold mb-2">Jurusan:</label>
                            <input type="text" wire:model="jurusan_anggota" class="shadow appearance-none border rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="jurusan_anggota" name="jurusan_anggota" required>
                            @error('jurusan_anggota')
                            <span class="text-red-500">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="no_telp_anggota" class="block text-gray-700 text-sm font-bold mb-2">Telepon:</label>
                            <input type="text" wire:model="no_telp_anggota" class="shadow appearance-none border rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="no_telp_anggota" name="no_telp_anggota" required>
                            @error('no_telp_anggota')
                            <span class="text-red-500">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="alamat_anggota" class="block text-gray-700 text-sm font-bold mb-2">Alamat:</label>
                            <textarea type="text" wire:model="alamat_anggota" class="shadow appearance-none border rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="alamat_anggota" name="alamat_anggota" required></textarea>
                            @error('alamat_anggota')
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
