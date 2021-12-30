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

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Buku = Buku::all();
        $Petugas = Petugas::all();
        $Anggota = Anggota::all();
        $Pengembalian = Pengembalian::getDetail()->paginate(10);
        return response()->json($Pengembalian);
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
            'denda' => 'required',
            'id_buku' => 'required',
            'id_anggota' => 'required',
            'id_petugas' => 'required'
        ]);
        try{
            $response = Pengembalian::create($validasi);
            $pengembalian = Pengembalian::get();
            foreach($pengembalian as $key => $value){
            $transaksi = Transaksi::updateOrCreate([
                    'id_pengembalian' =>  $value->id_pengembalian,
                    'id_anggota' => $value->id_anggota,
                    'id_buku' => $value->id_buku,
                    'denda'=> $value->denda
                ]);
            }
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
    public function update(Request $request, $id_pengembalian)
    {
        //
        $validasi=$request->validate([
            'denda' => 'required',
            'id_buku' => 'required',
            'id_anggota' => 'required',
            'id_petugas' => 'required'
        ]);
        try{
            $response = Pengembalian::find($id_pengembalian);
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
    public function destroy($id_pengembalian)
    {
        //
        try{
            $Pengembalian = Pengembalian::find($id_pengembalian);
            $Pengembalian->delete();
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
