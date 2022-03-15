<?php

namespace App\Modules\Penyuratan\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class ProcessSurat extends Controller
{
    public function __invoke($idx, $status){
        $surat = \App\Models\Surat::where('id', $idx)->first();
        $camunda = new \App\Http\Controllers\Camucont();
        $task = $camunda->getTaskId($surat->instance_id);
        if(!empty($task)){
            $variables = '{"variables":{ "jenisSurat" : {"value" : "'.$status.'"},"alasan" : {"value" : "sukses"} } }';
            $camunda->completeTask($task, $variables);
            $surat->jenis = $status;
            $surat->status ="wip";
            $surat->save();
            return redirect('/penyuratan');
        }
    }
}
