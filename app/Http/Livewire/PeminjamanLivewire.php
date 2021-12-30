<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Petugas;
use App\Models\Buku;
use Carbon\Carbon;

class PeminjamanLivewire extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $peminjaman1;
    public $peminjaman, $Anggota, $Petugas, $Buku, $id_peminjaman, $tanggal_pinjam, $tanggal_kembali, $id_buku, $id_anggota, $id_petugas, $request, $create_at;
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
            Peminjaman::where('created_at','Like', '%'.$this->request.'%')->with('Buku', 'Petugas', 'Anggota')->paginate(15)
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

        $this->created_at = Peminjaman::get('created_at');
        $this->tanggal_kembali = Carbon::now()->addDays(7);
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
        DB::beginTransaction();
        try{
        $this->validate([
            'tanggal_kembali' => 'required',
            'id_buku' => 'required',
            'id_anggota' => 'required',
            'id_petugas' => 'required'
        ]);
        $this->Buku = Buku::all();
        $this->Petugas = Petugas::all();
        $this->Anggota = Anggota::all();
        $this->Peminjaman = Peminjaman::all(); 
        Peminjaman::with('Buku', 'Petugas', 'Anggota')->updateOrCreate(['id_peminjaman'=> $this->id_peminjaman],
        [
            'tanggal_kembali' => $this->tanggal_kembali,
            'id_buku' => $this->id_buku,
            'id_anggota' => $this->id_anggota,
            'id_petugas' => $this->id_petugas,
            
        ]);

        session()->flash('message', $this->id_peminjaman ? $this->id_peminjaman . ' Diperbaharui':$this->id_peminjaman . ' Ditambahkan');
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

    public function edit($id_peminjaman)
    {
        DB::beginTransaction();
        try{
        $this->Buku = Buku::all();
        $this->Petugas = Petugas::all();
        $this->Anggota = Anggota::all();   
        $peminjaman = Peminjaman::with('Buku', 'Petugas', 'Anggota')->find($id_peminjaman);

        $this->id_peminjaman = $id_peminjaman;
        $this->created_at = $peminjaman->created_at;
        $this->tanggal_kembali = $peminjaman->tanggal_kembali;
        $this->id_buku = $peminjaman->id_buku;
        $this->id_anggota = $peminjaman->id_anggota;
        $this->id_petugas = $peminjaman->id_petugas;
        
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

    public function show($id_peminjaman)
    {
        $this->Buku = Buku::all();
        $this->Petugas = Petugas::all();
        $this->Anggota = Anggota::all();   
        $peminjaman = Peminjaman::with('Buku', 'Petugas', 'Anggota')->find($id_peminjaman);

        $this->id_peminjaman = $id_peminjaman;
        $this->id_peminjaman = $peminjaman->id_peminjaman;
        $this->created_at = $peminjaman->created_at;
        $this->tanggal_kembali = $peminjaman->tanggal_kembali;
        $this->id_buku = $peminjaman->id_buku;
        $this->id_anggota = $peminjaman->id_anggota;
        $this->id_petugas = $peminjaman->id_petugas;
        
        $this->openModal1();

    }

    public function delete($id_peminjaman)
    {
        DB::beginTransaction();
        try{
        $Buku = Buku::all();
        $Petugas = Petugas::all();
        $Anggota = Anggota::all();   
        $peminjaman = Peminjaman::with('Buku', 'Petugas', 'Anggota')->find($id_peminjaman);
        $peminjaman->delete();
        session()->flash('message', $peminjaman->tanggal_pinjam. ' Dihapus');
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
