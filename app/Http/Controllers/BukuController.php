<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\Transaksi;
use App\Models\Anggota;
use App\Models\Petugas;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Buku = Buku::paginate(10);
        return response()->json($Buku);
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
            'kode_buku' => 'required|string',
            'judul_buku' => 'required|string',
            'penulis_buku' => 'required|string',
            'penerbit_buku' => 'required|string',
            'tahun_penerbit' => 'required|string',
            'stok' => 'required|string'
        ]);
        try{
            $response = Buku::create($validasi);
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
    public function update(Request $request, $id_buku)
    {
        //
        $validasi=$request->validate([
            'kode_buku' => 'required|string',
            'judul_buku' => 'required|string',
            'penulis_buku' => 'required|string',
            'penerbit_buku' => 'required|string',
            'tahun_penerbit' => 'required|string',
            'stok' => 'required|string'
        ]);
        try{
            $response = Buku::find($id_buku);
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
    public function destroy($id_buku)
    {
        //
        try{
            $Buku = Buku::find($id_buku);
            $Buku->delete();
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
