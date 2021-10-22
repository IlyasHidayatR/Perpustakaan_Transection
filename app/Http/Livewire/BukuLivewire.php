<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Maatwebsite\excel\Facedes\Excel;
use App\Models\Buku;

class BukuLivewire extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $buku1;
    public $buku, $id_buku, $kode_buku, $judul_buku, $penulis_buku, $penerbit_buku, $tahun_penerbit, $stok, $request;
    public $isModal, $isModal1;

    protected $UpdatesQueryString = ['request'];

    public function mount()
    {
        $this->request = request()->query('request', $this->request);
    }

    public function render()
    {
        return view('livewire.buku',[
            'buku1'=> $this->request === null ?
            $this->buku1 = Buku::paginate(15):
            Buku::where('judul_buku','Like', '%'.$this->request.'%')->paginate(15)
        ])->layout('layouts.main');
    }

    public function create()
    {
        $this->resetFields();
        $this->openModal();
    }

    public function resetFields()
    {
        $this->kode_buku = '';
        $this->judul_buku = '';
        $this->penulis_buku = '';
        $this->penerbit_buku = '';
        $this->tahun_penerbit = '';
        $this->stok = '';
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
            'kode_buku' => 'required|string',
            'judul_buku' => 'required|string',
            'penulis_buku' => 'required|string',
            'penerbit_buku' => 'required|string',
            'tahun_penerbit' => 'required|string',
            'stok' => 'required|string'
        ]);
        DB::beginTransaction();
        Buku::updateOrCreate(['id_buku'=> $this->id_buku],
        [
            'kode_buku' => $this->kode_buku,
            'judul_buku' => $this->judul_buku,
            'penulis_buku' => $this->penulis_buku,
            'penerbit_buku' => $this->penerbit_buku,
            'tahun_penerbit' => $this->tahun_penerbit,
            'stok' => $this->stok
        ]);

        session()->flash('message', $this->id_buku ? $this->judul_buku . ' Diperbaharui':$this->judul_buku . ' Ditambahkan');
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

    public function edit($id_buku)
    {
        try{
        DB::beginTransaction();
        $buku = Buku::find($id_buku);

        $this->id_buku = $id_buku;
        $this->kode_buku = $buku->kode_buku;
        $this->judul_buku = $buku->judul_buku;
        $this->penulis_buku = $buku->penulis_buku;
        $this->penerbit_buku = $buku->penerbit_buku;
        $this->tahun_penerbit = $buku->tahun_penerbit;
        $this->stok = $buku->stok;
        
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

    public function show($id_buku)
    {
        $buku = Buku::find($id_buku);

        $this->id_buku = $id_buku;
        $this->id_buku = $buku->id_buku;
        $this->kode_buku = $buku->kode_buku;
        $this->judul_buku = $buku->judul_buku;
        $this->penulis_buku = $buku->penulis_buku;
        $this->penerbit_buku = $buku->penerbit_buku;
        $this->tahun_penerbit = $buku->tahun_penerbit;
        $this->stok = $buku->stok;
        
        $this->openModal1();

    }

    public function delete($id_buku)
    {
        try{
        DB::beginTransaction();
        $buku = Buku::find($id_buku);
        $buku->delete();
        session()->flash('message', $buku->judul_buku. ' Dihapus');
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
