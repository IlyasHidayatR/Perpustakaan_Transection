<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\Transaksi;
use App\Models\Anggota;
use App\Models\Petugas;
use App\Models\Buku;
use App\Models\Rak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Petugas = Petugas::paginate(10);
        return response()->json($Petugas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validasi=$request->validate([
            'nama_petugas' => 'required|string',
            'jabatan_petugas' => 'required|string',
            'no_telp_petugas' => 'required|string',
            'alamat_petugas' => 'required|string'
        ]);
        try{
            $response = Petugas::create($validasi);
            return response()->json([
                'success' => true,
                'message' => 'success',
                'data' => $response
            ]);
        } catch(\Throwable $e){
            return response()->json([
                'message' => 'Err',
                'errors' => $e->getMessage()
            ],422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_petugas)
    {
        //
        $validasi=$request->validate([
            'nama_petugas' => 'required|string',
            'jabatan_petugas' => 'required|string',
            'no_telp_petugas' => 'required|string',
            'alamat_petugas' => 'required|string'
        ]);
        try{
            $response = Petugas::find($id_petugas);
            $response->update($validasi);
            return response()->json([
                'success' => true,
                'message' => 'success',
                'data' => $response
            ]);
        } catch(\Throwable $e){
            return response()->json([
                'message' => 'Err',
                'errors' => $e->getMessage()
            ],422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_petugas)
    {
        //
        try{
            $Petugas = Petugas::find($id_petugas);
            $Anggota->delete();
            return response()->json([
            'success'=>true,
            'message'=>'Success'
            ]);
        } catch(\Throwable $e){
            return response()->json([
                'message' => 'Err',
                'errors' => $e->getMessage()
            ],422);
        }
    }
}
