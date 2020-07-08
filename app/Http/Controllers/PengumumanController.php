<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pengumuman;
use File;
use Image;

class PengumumanController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Pengumuman::get();
        if(request()->ajax()){
            return datatables()->of($data)->addIndexColumn()
                ->addColumn('action', function($pengumuman){

                    $btn = '<a href="/admin/pengumuman/'.$pengumuman->id_pengumuman.'/edit" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn .= '<button type="button" name="delete" id="'.$pengumuman->id_pengumuman.'" class="btn btn-danger btn-sm deletePengumuman" ><i class="fas fa-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
            
        return view('admin.pengumuman.indexpengumuman',compact('data'));
    }

    // menampilkan pengumuman
    public function indexmahasiswa()
    {
        $data = Pengumuman::orderBy('created_at','DESC')->get();
        return view('mahasiswa.pengumuman',compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Pengumuman::all();
        return view('admin.pengumuman.add_pengumuman',compact('data'));
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
            'judul' => 'required|string|max:100',
            'deskripsi' => 'nullable|string|max:500',
            'lampiran' => 'nullable|image|mimes:jpg,png,jpeg',
        ]);
        try {
            $lampiran = null;
            if ($request->hasFile('lampiran')) {
                $lampiran = $this->saveFile($request->name, $request->file('lampiran'));
            }

            $data = Pengumuman::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'lampiran' => $lampiran
            ]);
            return redirect(route('pengumuman.index'))
                ->with('alert-success','Berhasil Menambahkan Data!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    private function saveFile($judul, $lampiran)
    {
        $images = str_slug($judul) . time() . '.' . $lampiran->getClientOriginalExtension();
        $path = public_path('uploads/lampiran');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        } 
        Image::make($lampiran)->save($path . '/' . $images);
        return $images;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */

    //  menampilkan detail pengumuman
    public function show(Request $request)
    {
        $pengumuman = Pengumuman::where('id_pengumuman', $request->id_pengumuman)->first();
        return response()->json($pengumuman);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function edit($id_pengumuman)
    {
        $data = Pengumuman::findOrFail($id_pengumuman);
        return view('admin.pengumuman.edit_pengumuman', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_pengumuman)
    {
        $this->validate($request, [
            'judul' => 'required|string|max:100',
            'deskripsi' => 'nullable|string|max:500',
            'lampiran' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        try {
            $data = Pengumuman::findOrFail($id_pengumuman);
            $lampiran = $data->lampiran;

            if ($request->hasFile('lampiran')) {
                !empty($lampiran) ? File::delete(public_path('uploads/lampiran/' . $lampiran)):null;
                $lampiran = $this->saveFile($request->judul, $request->file('lampiran'));
            }

            $data->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'lampiran' => $lampiran
            ]);

            return redirect(route('pengumuman.index'))
            ->with('alert-success','Data berhasil diubah!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_pengumuman)
    {
        $data = Pengumuman::findOrFail($id_pengumuman);
        if (!empty($data->lampiran)) {
            File::delete(public_path('uploads/lampiran/' . $data->lampiran));
        }
        $data->delete();
        return response()->json(['message' => 'Pengumuman deleted successfully.']);
    }
}