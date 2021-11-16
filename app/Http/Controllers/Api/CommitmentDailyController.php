<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CommitmentDaily;
use App\Models\Notification;
use App\Models\EmployeeProject;
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
        $data = CommitmentDaily::whereDate('created_at',date('Y-m-d'))->where('employee_id',\Auth::user()->employee->id)->first();
        
        if(!$data) $data = new CommitmentDaily();
        
        $employee = isset(\Auth::user()->employee->id) ? \Auth::user()->employee : '';
        if($employee){
            $data->region_id = $employee->region_id;
            $data->sub_region_id = $employee->sub_region_id;
            $project = EmployeeProject::where('employee_id',$employee->id)->first();
            if($project) $data->client_project_id = $project->client_project_id; 
        }
        $data->employee_id = isset($employee->id) ? $employee->id : '';
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
        $data->is_submit = 1;
        $data->save();

        $commitment_daily = CommitmentDaily::select('commitment_dailys.*',\DB::raw("DATE_FORMAT(created_at, \"%d %M %Y\") as tanggal"))->whereDate('created_at',date('Y-m-d'))->where('id',$data->id)->first();
        
        // find notification
        $notification = Notification::whereDate('created_at',date('Y-m-d'))->where(['employee_id'=>\Auth::user()->employee->id,'type'=>1])->first();
        if($notification){
            $notification->is_read = 1;
            $notification->save();
        }

        \LogActivity::add('[apps] Commitment Daily Store');

        return response()->json(['message'=>'submited','data'=>$commitment_daily], 200);
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

        $params = CommitmentDaily::where('employee_id',\Auth::user()->employee->id)->orderBy('id','DESC')->paginate(10);
        $data = [];
        foreach($params as $key => $item){
            $data[$key] = $item;
            $data[$key]['tanggal'] = date('d M Y',strtotime($item->created_at));
        }
        $result['data'] = $data;
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

        $find = CommitmentDaily::whereDate('create_at',date('Y-m-d'))->where(['employee_id'=>\Auth::user()->employee->id,'is_submit'=>1])->first();

        if($find) $result['message'] = 'empty';

        return response()->json($result, 200);
    }
}
