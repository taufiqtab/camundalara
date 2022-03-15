<?php

namespace App\Modules\Penyuratan\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class ListSurat extends Controller
{
    public function __invoke(){
        $model = \App\Models\Surat::orderBy('id', 'desc')->get();
        return view('penyuratan::listsurat', ['surat' => $model]);
    }
}
