<?php

namespace App\Modules\Penyuratan\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class FinishSurat extends Controller
{
    public function __invoke($idx){
        $surat = \App\Models\Surat::where('id', $idx)->first();
        $camunda = new \App\Http\Controllers\Camucont();
        $task = $camunda->getTaskId($surat->instance_id);
        if(!empty($task)){
            // $variables = '{"variables":{ "jenisSurat" : {"value" : "keluar"} } }';
            $camunda->completeTask($task);
            $surat->status ="closed";
            $surat->save();
            return redirect('/penyuratan');
        }
    }
}
