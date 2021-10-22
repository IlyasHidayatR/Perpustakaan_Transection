<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\Transaksi;
use App\Models\Anggota;
use App\Models\Petugas;
use App\Models\Buku;

class PengembalianLivewire extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $pengembalian1;
    public $pengembalian, $Anggota, $Petugas, $Buku, $id_pengembalian, $tanggal_pengembalian, $denda, $id_buku, $id_anggota, $id_petugas, $request;
    public $transaksi, $id_transaksi, $id_peminjaman, $denda1, $id_buku1, $id_pengembalian1, $id_anggota1, $peminjaman;
    public $isModal, $isModal1, $key, $value;

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
        $this->peminjaman = Peminjaman::all();
        $this->pengembalian = Pengembalian::all();

        $this->denda = '';
        $this->id_buku = '';
        $this->id_anggota = '';
        $this->id_petugas = '';

        //$this->id_peminjaman = Peminjaman::get('id_peminjaman');
        //$this->id_pengembalian1 = Pengembalian::get('id_pengembalian');
        //$this->id_anggota1 = 



        //if ()
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
        try{
        $this->validate([
            'denda' => 'required|numeric',
            'id_buku' => 'required',
            'id_anggota' => 'required',
            'id_petugas' => 'required'
        ]);
        $this->Buku = Buku::all();
        $this->Petugas = Petugas::all();
        $this->peminjaman = Peminjaman::all();
        DB::beginTransaction(); 
        Pengembalian::updateOrCreate(['id_pengembalian'=> $this->id_pengembalian],
        [
            'denda' => $this->denda,
            'id_buku' => $this->id_buku,
            'id_anggota' => $this->id_anggota,
            'id_petugas' => $this->id_petugas,
            
        ]);

        $pengembalian = Pengembalian::get();
        foreach($pengembalian as $key => $value){
            Transaksi::create(
            [
               'id_pengembalian' =>  $value->id_pengembalian,
               'id_anggota' => $value->id_anggota,
               'id_buku' => $value->id_buku,
               'denda'=> $value->denda,
            ]);
        }

        session()->flash('message', $this->id_pengembalian ? $this->tanggal_pengembalian . ' Diperbaharui':$this->tanggal_pengembalian . ' Ditambahkan');
        $this->closeModal();
        $this->resetFields();
        DB::commit();
        }
        catch (\Throwable $th){
            DB::rollback();
            $this->closeModal();
            $this->resetFields();
            session()->flash('message', 'Terjadi Kesalahan');
        }
    }

    public function edit($id_pengembalian)
    {
        try{
        DB::beginTransaction();
        $this->Buku = Buku::all();
        $this->Petugas = Petugas::all();
        $this->Anggota = Anggota::all(); 
        $this->peminjaman = Peminjaman::all();  
        $pengembalian = Pengembalian::find($id_pengembalian);

        $this->id_pengembalian = $id_pengembalian;
        $this->denda = $pengembalian->denda;
        $this->id_buku = $pengembalian->id_buku;
        $this->id_anggota = $pengembalian->id_anggota;
        $this->id_petugas = $pengembalian->id_petugas;
        
        $this->openModal();
        DB::commit();
        }
        catch (\Throwable $th){
            DB::rollback();
            $this->closeModal();
            $this->resetFields();
            session()->flash('message', 'Terjadi Kesalahan');
        }

    }

    public function show($id_pengembalian)
    {
        $this->Buku = Buku::all();
        $this->Petugas = Petugas::all();
        $this->Anggota = Anggota::all();   
        $pengembalian = Pengembalian::with('Buku', 'Petugas', 'Anggota')->find($id_pengembalian);

        $this->id_pengembalian = $id_pengembalian;
        $this->id_pengembalian = $pengembalian->id_pengembalian;
        $this->created_at = $pengembalian->created_at;
        $this->denda = $pengembalian->denda;
        $this->id_buku = $pengembalian->id_buku;
        $this->id_anggota = $pengembalian->id_anggota;
        $this->id_petugas = $pengembalian->id_petugas;
        
        $this->openModal1();

    }

    public function delete($id_pengembalian)
    {
        try{
        DB::beginTransaction();
        $Buku = Buku::all();
        $Petugas = Petugas::all();
        $Anggota = Anggota::all();   
        $pengembalian = Pengembalian::with('Buku', 'Petugas', 'Anggota')->find($id_pengembalian);
        $pengembalian->delete();
        session()->flash('message', $pengembalian->tanggal_pengembalian. ' Dihapus');
        DB::commit();
        }
        catch (\Throwable $th){
            DB::rollback();
            $this->closeModal();
            $this->resetFields();
            session()->flash('message', 'Terjadi Kesalahan');
        }
    }
}
