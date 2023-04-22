<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PemesanResource;
use App\Models\Pemesan;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;

class PemesanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemesan = Pemesan::all();
        return new PemesanResource(true, 'Data Pemesan', $pemesan);
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
            'kodepemesan' => 'required|unique:pemesans,kodepemesan',
            'namapemesan' => 'required',
            'jeniskelamin' => 'required',
            'tempatlahir' => 'required',
            'tanggallahir' => 'required|numeric',
            'alamat' => 'required',
            'email' => 'required',
            'nohandphone' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        } else {
            $pemesan = Pemesan::create(
                [
                    'kodepemesan' => $request->kodepemesan,
                    'namapemesan' => $request->namapemesan,
                    'jeniskelamin' => $request->jeniskelamin,
                    'tempatlahir' => $request->tempatlahir,
                    'tanggallahir' => $request->tanggallahir,
                    'alamat' => $request->alamat,
                    'email' => $request->email, 
                    'nohandphone' => $request->nohandphone
                ]
                );

                return new PemesanResource(true, 'Data berhasil tersimpan', $pemesan);
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
        $pemesan = Pemesan::find($id);
        if ($pemesan) {
            return new PemesanResource(true, 'Data Ditemukan', $pemesan);
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
            'namapemesan' => 'required',
            'jeniskelamin' => 'required',
            'tempatlahir' => 'required',
            'tanggallahir' => 'required|numeric',
            'alamat' => 'required',
            'email' => 'required',
            'nohandphone' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        } else {
            $pemesan = Pemesan::find($id);
            if ($pemesan) {
                $pemesan->namapemesan = $request->namapemesan;
                $pemesan->jeniskelamin = $request->jeniskelamin;
                $pemesan->tempatlahir = $request->tempatlahir;
                $pemesan->tanggallahir = $request->tanggallahir;
                $pemesan->alamat = $request->alamat;
                $pemesan->email = $request->email;
                $pemesan->nohandphone = $request->nohandphone;
                $pemesan->save();


                return new PemesanResource(true, 'Data berhasil diperbarui', $pemesan);
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
        //
    }
}
