<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function index(){
        $model = \App\Models\Surat::orderBy('id', 'desc')->get();
        return view('surat', ['surat' => $model]);
    }

    public function create(){
        $camunda = new \App\Http\Controllers\Camucont();
        $instance = $camunda->startProcessByKey('penyuratan');
        if(!empty($instance)){
            $surat = new \App\Models\Surat();
            $surat->instance_id = $instance['id'];
            $surat->status ="open";
            $surat->jenis = "";
            if($surat->save()){
                return redirect('/surat');
            }else{
                dd("failed when save");
            }
        }else{
            dd("failed");
        }
    }

    public function updateMasuk($idx){
        $surat = \App\Models\Surat::where('id', $idx)->first();
        $camunda = new \App\Http\Controllers\Camucont();
        $task = $camunda->getTaskId($surat->instance_id);
        if(!empty($task)){
            $variables = '{"variables":{ "jenisSurat" : {"value" : "masuk"},"alasan" : {"value" : "dimasukan"} } }';
            $camunda->completeTask($task, $variables);
            $surat->jenis = "masuk";
            $surat->status ="wip";
            $surat->save();
            return redirect('/surat');
        }
    }

    public function updateKeluar($idx){
        $surat = \App\Models\Surat::where('id', $idx)->first();
        $camunda = new \App\Http\Controllers\Camucont();
        $task = $camunda->getTaskId($surat->instance_id);
        if(!empty($task)){
            $variables = '{"variables":{ "jenisSurat" : {"value" : "keluar"}, "alasan" : {"value" : "dikeluarkan"} } }';
            $camunda->completeTask($task, $variables);
            $surat->jenis = "keluar";
            $surat->status ="wip";
            $surat->save();
            return redirect('/surat');
        }
    }

    public function selesai($idx){
        $surat = \App\Models\Surat::where('id', $idx)->first();
        $camunda = new \App\Http\Controllers\Camucont();
        $task = $camunda->getTaskId($surat->instance_id);
        if(!empty($task)){
            // $variables = '{"variables":{ "jenisSurat" : {"value" : "keluar"} } }';
            $camunda->completeTask($task);
            $surat->status ="closed";
            $surat->save();
            return redirect('/surat');
        }
    }

   
}
