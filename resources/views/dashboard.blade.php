<x-app-layout>
@section('title','Home')
@section('judul','Home')
<div class="flex flex-wrap">
    <div class="w-full p-6">
        <h1><b>Teknik Informatika</b></h1>
        <hr>
        <h2>Ilyas Hidayat Rusdy</h2>
        <h2>1915101021</h2>
        <h2>Ilmu Komputer 4A</h2>
        <br>
        <center><img src="{{asset('gambar/buku.png')}}" style="height: 90px; width: 90px"></center>
        <p style="text-align: justify">
         Aplikasi ini adalah aplikasi sistem informasi perpustakaan. Maksud dari sistem informasi perpustakaan
         adalah sistem peminjaman buku perpustakaan. Aplikasi ini berfungsi sebagai penyimpanan data dari peminjaman
         buku dan juga sebagai penyimpanan informasi lainnya seperti anggota, petugas, dan buku.
        </p>
        <br>
        <b>Sistem Informasi ada pada laman tasks</b>
    </div>
</div>
</x-app-layout>

