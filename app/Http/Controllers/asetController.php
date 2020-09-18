<?php

namespace App\Http\Controllers;

use App\Models\asetModel;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Validation\Rule;
use Validator;


class asetController extends Controller
{
    public function index()
    {
 
            $aset = asetModel::all();
 
        return response()->json([
            'success' => true,
            'data' => $aset
        ]);
    }
 
    public function show($id)
    {
        $aset = asetModel::where('id_user','=',$id)->get();
 
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
    
        $validator = Validator::make($request->all(), [
            'kode_aset' => 'required|unique:App\Models\asetModel,kode_aset',
            'nama_aset' => 'required',
            'jumlah' => 'required|numeric',
            'merk' => 'required',
            'desc' => 'required'
        ]);
 
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }
 
        $aset = new asetModel();
        $aset->kode_aset = $request->kode_aset;
        $aset->nama_aset = $request->nama_aset;
        $aset->jumlah = $request->jumlah;
        $aset->merk = $request->merk;
        $aset->desc = $request->desc;
        $aset->id_user = 1;
        
        $aset->save();
 
        if ($aset!=null)
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
 
    public function update(Request $request)
    {
 
        $aset = asetModel::where('id_aset','=',$request->id_aset)->first();
 
        if (!$aset) {
            return response()->json([
                'success' => false,
                'message' => 'aset not found'
            ], 400);
        }
 
        $aset->kode_aset = $request->kode_aset;
        $aset->nama_aset = $request->nama_aset;
        $aset->jumlah = $request->jumlah;
        $aset->merk = $request->merk;
        $aset->desc = $request->desc;
        $aset->id_user = 1;
        $aset->save();
 
 
        if ($aset)
            return response()->json([
                'success' => true,
                'message' => 'aset has been updated'
                
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'aset can not be updated'
            ], 500);
    }
 
    public function destroy($id)
    {
        $aset = asetModel::where('id_aset','=',$id)->first();
 
        if (!$aset) {
            return response()->json([
                'success' => false,
                'message' => 'aset not found',
                'message' => 'aset has ben deleted'
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
