<?php

namespace App\Http\Controllers;

use App\Model\Nguoidung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NguoidungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nd = new Nguoidung();
        return $nd->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        if($request->has("ho") && $request->has("ten") && $request->has("dia_chi") && $request->has("tai_khoan") && $request->has("mat_khau"))
        {
            $nd = new Nguoidung();
            $nd->ho = $request->input("ho");
            $nd->ten = $request->input("ten");
            $nd->dia_chi = $request->input("dia_chi");
            $nd->tai_khoan = $request->input("tai_khoan");
            $nd->mat_khau = Hash::make($request->input("mat_khau"));
            $nd->save();
            return ["sc" => true];
        }
        return ["sc" => false];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nd = new Nguoidung();
        return $nd->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->has("ho") && $request->has("ten") && $request->has("dia_chi") &&  $request->has("trang_thai"))
        {
            $nd = Nguoidung::findOrFail($id);
            $nd->ho = $request->input("ho");
            $nd->ten = $request->input("ten");
            $nd->dia_chi = $request->input("dia_chi");
            if($request->has("mat_khau"))
            {
                $nd->mat_khau = Hash::make($request->input("mat_khau"));
            }
            $nd->trang_thai = (int)$request->input("trang_thai");
            $nd->update();
            return ["sc" => true];
        }
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nd = new Nguoidung();
        $nd = $nd->find($id);
        if($nd)
        {
            $nd->delete();
            return ["sc" => true];
        }
        return ["sc" => false];
    }
}
