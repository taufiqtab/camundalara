<?php

namespace App\Modules\Penyuratan\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class CreateSurat extends Controller
{
    public function __invoke(){
        $camunda = new \App\Http\Controllers\Camucont();
        $instance = $camunda->startProcessByKey('penyuratan');
        if(!empty($instance)){
            $surat = new \App\Models\Surat();
            $surat->instance_id = $instance['id'];
            $surat->status ="open";
            $surat->jenis = "";
            if($surat->save()){
                return redirect('/penyuratan');
            }else{
                dd("failed when save");
            }
        }else{
            dd("failed");
        }
    }
}
