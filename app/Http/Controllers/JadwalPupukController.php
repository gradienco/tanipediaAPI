<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Models\JadwalPupuk;


class JadwalPupukController extends Controller
{
    public function getJadwalPupuk(Request $request) {
        $jadwalPupuk = JadwalPupuk::all();
        return $this->responseOK("List jadwal pupuk", $jadwalPupuk);
    }

    public function detailJadwalPupuk(Request $request) {
        $jadwalPupuk = JadwalPupuk::find($request->id);
        return $this->responseOK("Detail jadwal pupuk", $jadwalPupuk);
    }

    public function insertJadwalPupuk(Request $request) {
        $validator = Validator::make($request->all(), [
            'tgl_distribusi'  => 'required',
        ]);
        if ($validator->fails()){
            return $this->responseError("Invalid Request", $validator->errors());
        }
        $jadwalPupuk = JadwalPupuk::create($request->all());
        return $this->responseOK("Tambah jadwal pupuk sukses", $jadwalPupuk);
    }

    public function updateJadwalPupuk(Request $request) {
        $jadwalPupuk = JadwalPupuk::find($request->id);
        //TODO:
        $jadwalPupuk->save();
        return $this->responseOK("Update jadwal pupuk sukses", $jadwalPupuk);
    }

    public function deleteJadwalPupuk(Request $request) {
        $jadwalPupuk = JadwalPupuk::find($request->id);
        if ($jadwalPupuk) {
            $jadwalPupuk->delete();
            return $this->responseOK("Hapus jadwal pupuk sukses", null);
        } else {
            return $this->responseError("Jadwal pupuk tidak ada");
        }
    }
}