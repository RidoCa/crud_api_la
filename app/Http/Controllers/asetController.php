<?php

namespace App\Http\Controllers;

use App\Models\asetModel;
use Illuminate\Http\Request;

class asetController extends Controller
{
    public function index()
    {
        $aset = auth()->user()->aset;
 
        return response()->json([
            'success' => true,
            'data' => $aset
        ]);
    }
 
    public function show($id)
    {
        $aset = auth()->user()->aset()->find($id);
 
        if (!$aset) {
            return response()->json([
                'success' => false,
                'message' => 'aset not found '
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $aset->toArray()
        ], 400);
    }
 
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_aset' => 'required|unique:App\Models\asetModel,kode_aset',
            'nama_aset' => 'required',
            'jumlah' => 'required|numeric',
            'kode_aset' => 'required',
            'merk' => 'required',
            'desc' => 'required'
            
            
        ]);
 
        $aset = new asetModel();
        $aset->kode_aset = $request->kode_aset;
        $aset->nama_aset = $request->nama_aset;
        $aset->jumlah = $request->jumlah;
        $aset->kode_aset = $request->kode_aset;
        $aset->merk = $request->merk;
        $aset->desc = $request->desc;
 
        if (auth()->user()->aset()->save($aset))
            return response()->json([
                'success' => true,
                'data' => $aset->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'aset not added'
            ], 500);
    }
 
    public function update(Request $request, $id)
    {
        $aset = auth()->user()->aset()->find($id);
 
        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'aset not found'
            ], 400);
        }
 
        $updated = $aset->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'aset can not be updated'
            ], 500);
    }
 
    public function destroy($id)
    {
        $aset = auth()->user()->aset()->find($id);
 
        if (!$aset) {
            return response()->json([
                'success' => false,
                'message' => 'aset not found'
            ], 400);
        }
 
        if ($aset->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'aset can not be deleted'
            ], 500);
        }
    }
}
