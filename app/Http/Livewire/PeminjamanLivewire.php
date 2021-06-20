<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Petugas;
use App\Models\Buku;

class PeminjamanLivewire extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $peminjaman1;
    public $peminjaman, $Anggota, $Petugas, $Buku, $id_peminjaman, $tanggal_pinjam, $tanggal_kembali, $id_buku, $id_anggota, $id_petugas, $request;
    public $isModal, $isModal1;

    protected $UpdatesQueryString = ['request'];

    public function mount()
    {
        $this->request = request()->query('request', $this->request);
    }

    public function render()
    {
        $this->Buku = Buku::all();
        $this->Petugas = Petugas::all();
        $this->Anggota = Anggota::all();
        return view('livewire.peminjaman',[
            'peminjaman1'=> $this->request === null ?
            $this->peminjaman1 = Peminjaman::with('Buku', 'Petugas', 'Anggota')->paginate(15):
            Peminjaman::where('tanggal_pinjam','Like', '%'.$this->request.'%')->with('Buku', 'Petugas', 'Anggota')->paginate(15)
        ])->layout('layouts.main');
    }

    public function create()
    {
        $this->resetFields();
        $this->openModal();
    }

    public function resetFields()
    {
        $this->Buku = Buku::all();
        $this->Petugas = Petugas::all();
        $this->Anggota = Anggota::all();

        $this->tanggal_pinjam = '';
        $this->tanggal_kembali = '';
        $this->id_buku = '';
        $this->id_anggota = '';
        $this->id_petugas = '';
    }

    public function openModal()
    {
        $this->isModal = true;
    }

    public function closeModal()
    {
        $this->isModal = false;
    }

    public function openModal1()
    {
        $this->isModal1 = true;
    }

    public function closeModal1()
    {
        $this->isModal1 = false;
    }

    public function store()
    {
        $this->validate([
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date',
            'id_buku' => 'required',
            'id_anggota' => 'required',
            'id_petugas' => 'required'
        ]);
        $this->Buku = Buku::all();
        $this->Petugas = Petugas::all();
        $this->Anggota = Anggota::all(); 
        Peminjaman::with('Buku', 'Petugas', 'Anggota')->updateOrCreate(['id_peminjaman'=> $this->id_peminjaman],
        [
            'tanggal_pinjam' => $this->tanggal_pinjam,
            'tanggal_kembali' => $this->tanggal_kembali,
            'id_buku' => $this->id_buku,
            'id_anggota' => $this->id_anggota,
            'id_petugas' => $this->id_petugas,
            
        ]);

        session()->flash('message', $this->id_peminjaman ? $this->tanggal_pinjam . ' Diperbaharui':$this->tanggal_pinjam . ' Ditambahkan');
        $this->closeModal();
        $this->resetFields();
    }

    public function edit($id_peminjaman)
    {
        $this->Buku = Buku::all();
        $this->Petugas = Petugas::all();
        $this->Anggota = Anggota::all();   
        $peminjaman = Peminjaman::with('Buku', 'Petugas', 'Anggota')->find($id_peminjaman);

        $this->id_peminjaman = $id_peminjaman;
        $this->tanggal_pinjam = $peminjaman->tanggal_pinjam;
        $this->tanggal_kembali = $peminjaman->tanggal_kembali;
        $this->id_buku = $peminjaman->id_buku;
        $this->id_anggota = $peminjaman->id_anggota;
        $this->id_petugas = $peminjaman->id_petugas;
        
        $this->openModal();

    }

    public function show($id_peminjaman)
    {
        $this->Buku = Buku::all();
        $this->Petugas = Petugas::all();
        $this->Anggota = Anggota::all();   
        $peminjaman = Peminjaman::with('Buku', 'Petugas', 'Anggota')->find($id_peminjaman);

        $this->id_peminjaman = $id_peminjaman;
        $this->id_peminjaman = $peminjaman->id_peminjaman;
        $this->tanggal_pinjam = $peminjaman->tanggal_pinjam;
        $this->tanggal_kembali = $peminjaman->tanggal_kembali;
        $this->id_buku = $peminjaman->id_buku;
        $this->id_anggota = $peminjaman->id_anggota;
        $this->id_petugas = $peminjaman->id_petugas;
        
        $this->openModal1();

    }

    public function delete($id_peminjaman)
    {
        $Buku = Buku::all();
        $Petugas = Petugas::all();
        $Anggota = Anggota::all();   
        $peminjaman = Peminjaman::with('Buku', 'Petugas', 'Anggota')->find($id_peminjaman);
        $peminjaman->delete();
        session()->flash('message', $peminjaman->tanggal_pinjam. ' Dihapus');
    }
}
