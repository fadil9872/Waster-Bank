<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Sampah;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        return view('admin.index');
    }
    public function sampah() {
        $sampah = Sampah::get();
        return view('admin.sampah.index', compact('sampah'));
    }
    public function addSampah(Request $request) {
        $sampah = Sampah::create([
            'nama'  =>  $request->nama,
            'harga' =>  $request->harga,
        ]);

        return redirect('admin/sampah')->with('status', 'Barang berhasil ditambah');
    }
    
    public function ubahSampah(Request $request, $id) {
        $old_sampah = Sampah::where('id', $id)->first();
        $new_sampah = $old_sampah->update([
            'nama'  =>  $request->nama,
            'harga' =>  $request->harga,
        ]);

        return redirect('admin/sampah')->with('status', 'Barang berhasil update');
    }

    public function hapusSampah($id) {
        $old_sampah = Sampah::where('id', $id)->first();

        $old_sampah->delete();

        return redirect('admin/sampah')->with('status', 'Barang berhasil dihapus');
    }

    public function cari(Request $request) {
        $nama = $request->nama;
        $sampahs = Sampah::where('nama','like',"%".$nama."%")->paginate(5);
        return view('admin.sampah.cari',compact('sampahs'));
    }
}
