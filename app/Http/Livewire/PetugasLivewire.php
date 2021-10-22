<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Maatwebsite\excel\Facedes\Excel;
use App\Models\Petugas;

class PetugasLivewire extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $petugas1;
    public $petugas, $id_petugas, $nama_petugas, $jabatan_petugas, $no_telp_petugas, $alamat_petugas, $request;
    public $isModal, $isModal1;

    protected $UpdatesQueryString = ['request'];

    public function mount()
    {
        $this->request = request()->query('request', $this->request);
    }

    public function render()
    {
        return view('livewire.petugas', [
            'petugas1'=> $this->request === null ?
            $this->petugas1 = Petugas::paginate(15):
            Petugas::where('nama_petugas','Like', '%'.$this->request.'%')->paginate(15)
        ])->layout('layouts.main');
    }

    public function create()
    {
        $this->resetFields();
        $this->openModal();
    }

    public function resetFields()
    {
        $this->nama_petugas = '';
        $this->jabatan_petugas = '';
        $this->no_telp_petugas = '';
        $this->alamat_petugas = '';
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
            'nama_petugas' => 'required|string',
            'jabatan_petugas' => 'required|string',
            'no_telp_petugas' => 'required|string',
            'alamat_petugas' => 'required|string'
        ]);
        DB::beginTransaction();
        Petugas::updateOrCreate(['id_petugas'=> $this->id_petugas],
        [
            'nama_petugas' => $this->nama_petugas,
            'jabatan_petugas' => $this->jabatan_petugas,
            'no_telp_petugas' => $this->no_telp_petugas,
            'alamat_petugas' => $this->alamat_petugas
        ]);

        session()->flash('message', $this->id_petugas ? $this->nama_petugas . ' Diperbaharui':$this->nama_petugas . ' Ditambahkan');
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

    public function edit($id_petugas)
    {
        try{
        DB::beginTransaction();
        $petugas = Petugas::find($id_petugas);

        $this->id_petugas = $id_petugas;
        $this->nama_petugas = $petugas->nama_petugas;
        $this->jabatan_petugas = $petugas->jabatan_petugas;
        $this->no_telp_petugas = $petugas->no_telp_petugas;
        $this->alamat_petugas = $petugas->alamat_petugas;
        
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

    public function show($id_petugas)
    {
        $petugas = Petugas::find($id_petugas);

        $this->id_petugas = $id_petugas;
        $this->id_petugas = $petugas->id_petugas;
        $this->nama_petugas = $petugas->nama_petugas;
        $this->jabatan_petugas = $petugas->jabatan_petugas;
        $this->no_telp_petugas = $petugas->no_telp_petugas;
        $this->alamat_petugas = $petugas->alamat_petugas;
        
        $this->openModal1();

    }

    public function delete($id_petugas)
    {
        try{
        DB::beginTransaction();
        $petugas = Petugas::find($id_petugas);
        $petugas->delete();
        session()->flash('message', $petugas->nama_petugas. ' Dihapus');
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
