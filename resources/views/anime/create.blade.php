<x-app-layout>
@section('title','Create')
@section('judul','Tambah Data')
<div class="flex flex-wrap">
        <div class="w-full p-6">
            <h1><b>Data Anime</b></h1>
            <hr>
            <h1><i><b>Input Data</b></i></h1>
            <form method="post"action="/getanime/{id_genre}">
                @csrf
                <div class="form-group">
                    <label for="skor" class="form-label">Nama Anime: </label><br>
                    <input type="text" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3" id="nama_anime" name="nama_anime" placeholder="Masukkan Judul" value="{{old ('nama_anime')}}">
                </div>
                <div class="form-group">
                    <label for="skor" class="form-label">Genre Anime: </label><br>
                    <select class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3" style="width: 100" name="id_buku" id="id_buku" required>
                        <option disable value>Pilih Genre</option>
                        @foreach($genre as $bk)
                        <option value="{{$bk->id_genre}}">{{$bk->nama_genre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="skor" class="form-label">Deskripsi: </label><br>
                    <textarea name="deskripsi" id="deskripsi" class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3" cols="30" rows="10" placeholder="Penjelasan"></textarea>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" name="submit" class="md:w-full bg-gray-900 text-white font-bold py-2 px-4 border-b-4 hover:border-b-2 border-gray-500 hover:border-gray-100 rounded-full" style="background-color:brown; color:white;">Submit</button> <br>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="md:w-full bg-gray-900 text-white font-bold py-2 px-4 border-b-4 hover:border-b-2 border-gray-500 hover:border-gray-100 rounded-full" style="background-color:blue"><a href="/anime" style="color:white">Kembali</a></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>