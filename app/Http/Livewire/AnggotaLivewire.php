<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Anggota;
use App\Imports\AnggotaImport;
use App\Exports\AnggotaExport;

class AnggotaLivewire extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $anggota1; 
    public $id_anggota, $anggota, $kode_anggota, $nama_anggota, $jk_anggota, $jurusan_anggota, $no_telp_anggota, $alamat_anggota, $file, $request;
    public $isModal, $isModal1;

    protected $UpdatesQueryString = ['request'];

    public function mount()
    {
        $this->request = request()->query('request', $this->request);
    }

    public function render()
    {
        return view('livewire.anggota',[
            'anggota1'=> $this->request === null ?
            $this->anggota1 = Anggota::paginate(15):
            Anggota::where('nama_anggota','Like', '%'.$this->request.'%')->paginate(15)
        ])->layout('layouts.main');
    }

    public function create()
    {
        $this->resetFields();
        $this->openModal();
    }

    public function resetFields()
    {
        $this->kode_anggota = '';
        $this->nama_anggota = '';
        $this->jk_anggota = '';
        $this->jurusan_anggota = '';
        $this->no_telp_anggota = '';
        $this->alamat_anggota = '';
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
            'kode_anggota' => 'required|string',
            'nama_anggota' => 'required|string',
            'jk_anggota' => 'required|max:1',
            'jurusan_anggota' => 'required|string',
            'no_telp_anggota' => 'required|string',
            'alamat_anggota' => 'required|string'
        ]);

        Anggota::updateOrCreate(['id_anggota'=> $this->id_anggota],
        [
            'kode_anggota' => $this->kode_anggota,
            'nama_anggota' => $this->nama_anggota,
            'jk_anggota' => $this->jk_anggota,
            'jurusan_anggota' => $this->jurusan_anggota,
            'no_telp_anggota' => $this->no_telp_anggota,
            'alamat_anggota' => $this->alamat_anggota
        ]);

        session()->flash('message', $this->id_anggota ? $this->nama_anggota . ' Diperbaharui':$this->nama_anggota . ' Ditambahkan');
        $this->closeModal();
        $this->resetFields();
    }

    public function edit($id_anggota)
    {
        $anggota = Anggota::find($id_anggota);

        $this->id_anggota = $id_anggota;
        $this->kode_anggota = $anggota->kode_anggota;
        $this->nama_anggota = $anggota->nama_anggota;
        $this->jk_anggota = $anggota->jk_anggota;
        $this->jurusan_anggota = $anggota->jurusan_anggota;
        $this->no_telp_anggota = $anggota->no_telp_anggota;
        $this->alamat_anggota = $anggota->alamat_anggota;
        
        $this->openModal();

    }

    public function show($id_anggota)
    {
        $anggota = Anggota::find($id_anggota);

        $this->id_anggota = $id_anggota;
        $this->id_anggota = $anggota->id_anggota;
        $this->kode_anggota = $anggota->kode_anggota;
        $this->nama_anggota = $anggota->nama_anggota;
        $this->jk_anggota = $anggota->jk_anggota;
        $this->jurusan_anggota = $anggota->jurusan_anggota;
        $this->no_telp_anggota = $anggota->no_telp_anggota;
        $this->alamat_anggota = $anggota->alamat_anggota;
        
        $this->openModal1();

    }

    public function delete($id_anggota)
    {
        $anggota = Anggota::find($id_anggota);
        $anggota->delete();
        session()->flash('message', $anggota->nama_anggota. ' Dihapus');
    }

    public function submit()
    {
        $this->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);
        
        Excel::import(new AnggotaImport, $this->file);
        //dd($this->file);
        session()->flash('message', 'File di import');
        

    }

    public function export()
    {
        return Excel::download(new AnggotaExport, 'Anggota.xlsx');
    }
}
