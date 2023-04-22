<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\KamarResource;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kamar = Kamar::all();
        return new KamarResource(true, 'Data Kamar', $kamar);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nokamar' => 'required|unique:kamars,nokamar',
            'namakamar' => 'required',
            'harga' => 'required|numeric',
            'lantai' => 'required|numeric',
            'jeniskamar' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        } else {
            $kamar = Kamar::create(
                [
                    'nokamar' => $request->nokamar,
                    'namakamar' => $request->namakamar,
                    'harga' => $request->harga,
                    'lantai' => $request->lantai,
                    'jeniskamar' => $request->jeniskamar,
                    'status' => $request->status
                ]
                );

                return new KamarResource(true, 'Data berhasil tersimpan', $kamar);
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
        $kamar = Kamar::find($id);
        if ($kamar) {
            return new KamarResource(true, 'Data Ditemukan', $kamar);
        } else {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ],422);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[            
            'namakamar' => 'required',
            'harga' => 'required|numeric',
            'lantai' => 'required|numeric',
            'jeniskamar' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        } else {
            $kamar = Kamar::find($id);
            if ($kamar) {
                $kamar->namakamar = $request->namakamar;
                $kamar->harga = $request->harga;
                $kamar->lantai = $request->lantai;
                $kamar->jeniskamar = $request->jeniskamar;
                $kamar->status = $request->status;
                $kamar->save();


                return new KamarResource(true, 'Data berhasil diperbarui', $kamar);
            } else {
                return response()->json([
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kamar = Kamar::find($id);
            if ($kamar) {
                $kamar->delete();


                return new KamarResource(true, 'Data berhasil dihapus', '');
            } else {
                return response()->json([
                    'message' => 'Data tidak ditemukan'
                ]);
            }
    }
}
