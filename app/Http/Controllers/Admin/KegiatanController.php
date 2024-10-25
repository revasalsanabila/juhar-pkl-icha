<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\kegiatan;
use App\Models\Admin\Pembimbing;
use App\Models\Admin\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KegiatanController extends Controller
{
    public function kegiatan($id, $id_siswa)
    {
        $loginGuru = Auth::guard('guru')->user()->id_guru;
        $siswa = Siswa::find($id_siswa);

        if (!$siswa || !$siswa->id_pembimbing) {
            return back()->withErrors(['access' => 'Siswa tidak ditemukan atau tidak memiliki pembimbing']);
        }
        if ($siswa->id_pembimbing != $id) {
            return back()->withErrors(['access' => 'Pembimbing tidak sesuai']);
        }
        $pembimbing = Pembimbing::find($id);
        if (!$pembimbing || $pembimbing->id_guru !== $loginGuru) {
            return back()->withErrors(['access' => 'Akses anda di tolak, siswa ini tidak dibimbing oleh anda']);
        }
        $kegiatans = kegiatan::where('id_siswa', $id_siswa)->get();
        $kegiatan = kegiatan::where('id_siswa', $id_siswa)->first();
        $id_pembimbing = $id;

        return view('guru.kegiatan', compact('id_pembimbing','kegiatans','kegiatan'));
    }
}
