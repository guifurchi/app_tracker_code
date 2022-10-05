<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\inspect as api;

class apiController extends Controller
{
    public function index()
    {
        api::all();
        return view('QRcode', [
            'title' => '', 
            'action' => '',
            'erro' => ''
        ]);

    }

    public function create(Request $request)
    {
        return api::create($request->all());
    }

    public function Show($qrcode = null)
    {
        return api::where('qrcode', $qrcode)->get();
    }

    public function update(Request $request, $id)
    {
        $inspect = api::findOrFail($id);
        $inspect->update($request->all());
    }

    public function destroy($id)
    {
        $inspect = api::findOrFail($id);
        $inspect->delete();
    }
}
