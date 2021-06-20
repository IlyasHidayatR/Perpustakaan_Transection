<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Pengembalian;
use App\Models\Anggota;
use App\Models\Petugas;
use App\Models\Buku;

class PengembalianLivewire extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $pengembalian1;
    public $pengembalian, $Anggota, $Petugas, $Buku, $id_pengembalian, $tanggal_pengembalian, $denda, $id_buku, $id_anggota, $id_petugas, $request;
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
        return view('livewire.pengembalian', [
            'pengembalian1'=> $this->request === null ?
            $this->pengembalian1 = Pengembalian::with('Buku', 'Petugas', 'Anggota')->paginate(15):
            Pengembalian::where('tanggal_pengembalian','Like', '%'.$this->request.'%')->with('Buku', 'Petugas', 'Anggota')->paginate(15)
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

        $this->tanggal_pengembalian = '';
        $this->denda = '';
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
            'tanggal_pengembalian' => 'required|date',
            'denda' => 'required|numeric',
            'id_buku' => 'required',
            'id_anggota' => 'required',
            'id_petugas' => 'required'
        ]);
        $this->Buku = Buku::all();
        $this->Petugas = Petugas::all();
        $this->Anggota = Anggota::all(); 
        Pengembalian::with('Buku', 'Petugas', 'Anggota')->updateOrCreate(['id_pengembalian'=> $this->id_pengembalian],
        [
            'tanggal_pengembalian' => $this->tanggal_pengembalian,
            'denda' => $this->denda,
            'id_buku' => $this->id_buku,
            'id_anggota' => $this->id_anggota,
            'id_petugas' => $this->id_petugas,
            
        ]);

        session()->flash('message', $this->id_pengembalian ? $this->tanggal_pengembalian . ' Diperbaharui':$this->tanggal_pengembalian . ' Ditambahkan');
        $this->closeModal();
        $this->resetFields();
    }

    public function edit($id_pengembalian)
    {
        $this->Buku = Buku::all();
        $this->Petugas = Petugas::all();
        $this->Anggota = Anggota::all();   
        $pengembalian = Pengembalian::with('Buku', 'Petugas', 'Anggota')->find($id_pengembalian);

        $this->id_pengembalian = $id_pengembalian;
        $this->tanggal_pengembalian = $pengembalian->tanggal_pengembalian;
        $this->denda = $pengembalian->denda;
        $this->id_buku = $pengembalian->id_buku;
        $this->id_anggota = $pengembalian->id_anggota;
        $this->id_petugas = $pengembalian->id_petugas;
        
        $this->openModal();

    }

    public function show($id_pengembalian)
    {
        $this->Buku = Buku::all();
        $this->Petugas = Petugas::all();
        $this->Anggota = Anggota::all();   
        $pengembalian = Pengembalian::with('Buku', 'Petugas', 'Anggota')->find($id_pengembalian);

        $this->id_pengembalian = $id_pengembalian;
        $this->id_pengembalian = $pengembalian->id_pengembalian;
        $this->tanggal_pengembalian = $pengembalian->tanggal_pengembalian;
        $this->denda = $pengembalian->denda;
        $this->id_buku = $pengembalian->id_buku;
        $this->id_anggota = $pengembalian->id_anggota;
        $this->id_petugas = $pengembalian->id_petugas;
        
        $this->openModal1();

    }

    public function delete($id_pengembalian)
    {
        $Buku = Buku::all();
        $Petugas = Petugas::all();
        $Anggota = Anggota::all();   
        $pengembalian = Pengembalian::with('Buku', 'Petugas', 'Anggota')->find($id_pengembalian);
        $pengembalian->delete();
        session()->flash('message', $pengembalian->tanggal_pengembalian. ' Dihapus');
    }
}
