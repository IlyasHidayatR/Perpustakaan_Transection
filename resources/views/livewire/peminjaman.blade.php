@section('title','Data')
@section('judul','Tasks')
@section('page','/peminjaman')
@section('request','request')

<div class="flex flex-wrap">
    <div class="w-full p-6">
    <div class="bg-white">
        <nav class="flex flex-col sm:flex-row">
            <button class="text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none text-blue-500 border-b-2 font-medium border-blue-500">
            <a href="{{ route('peminjaman') }}" :active="request()->routeIs('peminjaman')">Peminjaman</a>
            </button><button class="text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none">
            <a href="{{ route('pengembalian') }}" :active="request()->routeIs('pengembalian')">Pengembalian</a>
            </button><button class="text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none">
            <a href="{{ route('anggota') }}" :active="request()->routeIs('anggota')">Anggota</a>
            </button><button class="text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none">
            <a href="{{ route('petugas') }}" :active="request()->routeIs('petugas')">Petugas</a>
            </button><button class="text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none">
            <a href="{{ route('buku') }}" :active="request()->routeIs('buku')">Buku</a>
            </button><button class="text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none">
            <a href="{{ route('rak') }}" :active="request()->routeIs('rak')">Rak</a>
            </button>
        </nav>
    </div>
    <hr>
    <h2><b>Daftar Peminjaman</b></h2>
            <hr>
            <button wire:click="create()" class="box row-span-2 overflow-hidden grid-cols-1 grid-rows-2 gap-2" style="background-color:blue; color:white">Tambah Data</button>
            @if ($isModal)
                    @include('livewire.createpeminjaman')
            @endif
            <a href="#" class="box row-span-2 overflow-hidden grid-cols-1 grid-rows-2 gap-2" style="background-color:brown; color:white">Export</a>
            <button onclick="openModal(true)">
                <a class="box row-span-2 overflow-hidden grid-cols-1 grid-rows-2 gap-2" style="background-color:green; color:white">Import</a>
            </button>
            <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- overlay -->
            <div id="modal_overlay" class="hidden absolute inset-0 bg-black bg-opacity-30 h-screen w-full flex justify-center items-start md:items-center pt-10 md:pt-0">

                <!-- modal -->
                <div id="modal" class="pacity-0 transform -translate-y-full scale-150  relative w-10/12 md:w-1/2 h-1/2 md:h-3/4 bg-white rounded shadow-lg transition-opacity transition-transform duration-300">

                    
                    <!-- header -->
                    <div class="px-4 py-3 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-600">Upload File</h2>
                    </div>

                    <!-- body -->
                        <div class="w-full p-3">
                            <div class="form-group">
                            <label for="file">Masukkan file excel:</label>
                            <br>
                            <input type="file" id="file" name="file" required>
                            </div>
                        </div>

                        <!-- footer -->
                        <div class="absolute bottom-0 left-0 px-4 py-3 border-t border-gray-200 w-full flex justify-end items-center gap-3">
                        <div class="form-group">
                        <button type="submit" name="upload" class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded text-white focus:outline-none">Save</button>
                        </div>
                        <button onclick="openModal(false)" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white focus:outline-none">
                            Close
                        </button>
                    </div>
                </div>

            </div>

            <script>
                const modal_overlay = document.querySelector('#modal_overlay');
                const modal = document.querySelector('#modal');

                function openModal (value){
                const modalCl = modal.classList
                const overlayCl = modal_overlay

                if(value){
                overlayCl.classList.remove('hidden')
                setTimeout(() => {
                    modalCl.remove('opacity-0')
                    modalCl.remove('-translate-y-full')
                    modalCl.remove('scale-150')
                }, 100);
                } else {
                modalCl.add('-translate-y-full')
                setTimeout(() => {
                    modalCl.add('opacity-0')
                    modalCl.add('scale-150')
                }, 100);
                setTimeout(() => overlayCl.classList.add('hidden'), 300);
                    }
                }
                openModal(false)
            </script>
            </form>
            @if(session('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                {{session('message')}}
            </div>
            @endif
            <table class="bg-white text-gray-900 w-full shadow-none">
                <thead>
                    <tr>
                    <th class="bg-blue-700 text-white p-2">No.</th>
                    <th class="bg-blue-700 text-white p-2">Tanggal Pinjam</th>
                    <th class="bg-blue-700 text-white p-2">Tanggal Kembali</th>
                    <th class="bg-blue-700 text-white p-2">Buku</th>
                    <th class="bg-blue-700 text-white p-2">Nama Anggota</th>
                    <th class="bg-blue-700 text-white p-2">Nama Petugas</th>
                    <th class="bg-blue-700 text-white p-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($peminjaman1 as $pj)
                <tr class="bg-blue-100 text-blue-900">
                <!-- $loop->iteration -->
                <th class="p-2">{{$loop->iteration}}.</th>
                    <th class="p-2">{{$pj->created_at}}</th>
                    <th class="p-2">{{$pj->tanggal_kembali}}</th>
                    <th class="p-2">{{$pj->Buku->judul_buku}}</th>
                    <th class="p-2">{{$pj->Anggota->nama_anggota}}</th>
                    <th class="p-2">{{$pj->Petugas->nama_petugas}}</th>
                    <th class="p-2">
                        <button wire:click="show({{$pj->id_peminjaman}})" class="border" style="background-color:aqua; color:white">detail</button>
                        @if ($isModal1)
                            @include('livewire.detailpeminjaman')
                        @endif
                        <button wire:click="edit({{$pj->id_peminjaman}})" class="border" style="background-color:green; color:white">edit</button>
                        <button wire:click="delete({{$pj->id_peminjaman}})" class="badge badge-danger inline border" style="background-color:red; color:white">delete</button>
                    </th>
                </tr>
                @empty
                    <tr>
                        <th class="p-2 text-center" colspan="S">Tidak ada data</th>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="inline-flex mt-2 xs:mt-0">
                <nav class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-l inline">
                {{$peminjaman1->links()}}
                </nav>
            </div>
        </div>
    </div>