<?php

namespace App\Http\Controllers;

use App\Periode;

use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodes = Periode::get();
        return view('admin.periode.periodeListing',compact('periodes'));
    }

    public function changeStatus(Request $request){
        $periode = Periode::findOrFail($request->periode_id);
        $periode->status = $request->status;
        $periode->save();

        return response()->json(['message' => 'Periode status updated successfully.']);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.periode.add_new_periode');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'tahun_periode' => 'required|max:4',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
        ]);
        $data = Periode::create([
            'tahun_periode' => $request->tahun_periode,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai
        ]);
        $data->save();
        return response()->json(['message' => 'Periode status added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_periode)
    {
        $data = Periode::findOrFail($id_periode);
        return view('admin.periode.edit_periode', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_periode)
    {
        $this->validate($request, [
            'tahun_periode' => 'required|max:4',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
        ]);
        $data = Periode::findOrFail($id_periode);
        $data->update([
            'tahun_periode' => $request->tahun_periode,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai
        ]);

        $data->save();
        return response()->json(['message' => 'Periode update successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_periode)
    {
        $periode = Periode::find($id_periode);
        $periode->delete();
        return response()->json(['message' => 'Periode deleted successfully.']);    
    }
}
