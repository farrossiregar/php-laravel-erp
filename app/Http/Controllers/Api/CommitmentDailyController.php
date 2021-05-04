<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CommitmentDaily;
use Illuminate\Http\Request;

class CommitmentDailyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $this->validate($request,
        [
            'regulasi_terkait_ppe_apd_menggunakan' => 'required',
            'regulasi_terkait_sanksi' => 'required',
            'regulasi_terhadap_kecurian' => 'required',
            'regulasi_terhadap_kerusakan_nama_baik_perusahaan' => 'required',
            'regulasi_terkait_minuman_keras_obat_terlarang' => 'required',
            'regulasi_terkait_pelanggaran_peraturan_perusahaan' => 'required',
            'regulasi_terkait_protokol_kesehatan' => 'required',
            'regulasi_terkait_penggunaan_kendaraan' => 'required',
            'regulasi_bcg' => 'required',
            'regulasi_terkait_cyber_security' => 'required'
        ]);

        // check exist
        $find = CommitmentDaily::whereDate('created_at',date('Y-m-d'))->where('employee_id',\Auth::user()->employee->id)->first();
        if($find) return response()->json(['message'=>'exist'], 200);
        
        $data = new CommitmentDaily();
        $data->employee_id = isset(\Auth::user()->employee->id) ? \Auth::user()->employee->id : '';
        $data->regulasi_terkait_ppe_apd_menggunakan = $request->regulasi_terkait_ppe_apd_menggunakan;
        $data->regulasi_terkait_ppe_apd_tidak_punya = $request->regulasi_terkait_ppe_apd_tidak_punya;
        $data->regulasi_terkait_sanksi = $request->regulasi_terkait_sanksi;
        $data->regulasi_terhadap_kecurian = $request->regulasi_terhadap_kecurian;
        $data->regulasi_terhadap_kerusakan_nama_baik_perusahaan = $request->regulasi_terhadap_kerusakan_nama_baik_perusahaan;
        $data->regulasi_terkait_minuman_keras_obat_terlarang = $request->regulasi_terkait_minuman_keras_obat_terlarang;
        $data->regulasi_terkait_pelanggaran_peraturan_perusahaan = $request->regulasi_terkait_pelanggaran_peraturan_perusahaan;
        $data->regulasi_terkait_protokol_kesehatan = $request->regulasi_terkait_protokol_kesehatan;
        $data->regulasi_terkait_penggunaan_kendaraan = $request->regulasi_terkait_penggunaan_kendaraan;
        $data->regulasi_bcg = $request->regulasi_bcg;
        $data->regulasi_terkait_cyber_security = $request->regulasi_terkait_cyber_security;
        $data->save();

        return response()->json(['message'=>'submited'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $result['code'] = 200;
        $result['message'] = 'success';

        $result['data'] = CommitmentDaily::where('employee_id',\Auth::user()->employee->id)->get();

        return response()->json($result, 200);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function check()
    {
        $result['code'] = 200;
        $result['message'] = 'success';

        $find = CommitmentDaily::whereDate('create_at',date('Y-m-d'))->where('employee_id',\Auth::user()->employee->id)->first();

        if($find) $result['message'] = 'empty';

        return response()->json($result, 200);
    }
}
