<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Maatwebsite\excel\Facedes\Excel;
use App\Models\Rak;
use App\Models\Buku;

class RakLivewire extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $rak1;
    public $rak, $Buku, $id_rak, $nama_rak, $lokasi_rak, $id_buku, $request;
    public $isModal, $isModal1;

    protected $UpdatesQueryString = ['request'];

    public function mount()
    {
        $this->request = request()->query('request', $this->request);
    }

    public function render()
    {
        $this->Buku = Buku::all();
        return view('livewire.rak',[
            'rak1'=> $this->request === null ?
            $this->rak1 = Rak::with('Buku')->paginate(15):
            Rak::where('nama_rak','Like', '%'.$this->request.'%')->with('Buku')->paginate(15)
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

        $this->nama_rak = '';
        $this->lokasi_rak = '';
        $this->id_buku = '';
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
            'nama_rak' => 'required|string',
            'lokasi_rak' => 'required|string',
            'id_buku' => 'required',
        ]);
        $this->Buku = Buku::all();
        Rak::with('Buku')->updateOrCreate(['id_rak'=> $this->id_rak],
        [
            'nama_rak' => $this->nama_rak,
            'lokasi_rak' => $this->lokasi_rak,
            'id_buku' => $this->id_buku,
            
        ]);

        session()->flash('message', $this->id_rak ? $this->nama_rak . ' Diperbaharui':$this->nama_rak . ' Ditambahkan');
        $this->closeModal();
        $this->resetFields();
    }

    public function edit($id_rak)
    {
        $this->Buku = Buku::all();   
        $rak = Rak::with('Buku')->find($id_rak);

        $this->id_rak = $id_rak;
        $this->nama_rak = $rak->nama_rak;
        $this->lokasi_rak = $rak->lokasi_rak;
        $this->id_buku = $rak->id_buku;
        
        $this->openModal();

    }

    public function show($id_rak)
    {
        $this->Buku = Buku::all();   
        $rak = Rak::with('Buku')->find($id_rak);

        $this->id_rak = $id_rak;
        $this->id_rak = $rak->id_rak;
        $this->nama_rak = $rak->nama_rak;
        $this->lokasi_rak = $rak->lokasi_rak;
        $this->id_buku = $rak->id_buku;
        
        $this->openModal1();

    }

    public function delete($id_rak)
    {
        $Buku = Buku::all();   
        $rak = Rak::with('Buku')->find($id_rak);
        $rak->delete();
        session()->flash('message', $rak->nama_rak. ' Dihapus');
    }
}
