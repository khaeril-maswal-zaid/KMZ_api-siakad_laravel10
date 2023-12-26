<?php

namespace App\Http\Controllers;

use App\Http\Resources\KodeBayarResource;
use App\Http\Resources\ProdiFakultasResource;
use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        $prodis = Prodi::all();
        return response()->json($prodis);
    }

    public function show($id)
    {
        $prodi = Prodi::with('getFakultas')->findOrFail($id);
        return new ProdiFakultasResource($prodi);
    }
}
