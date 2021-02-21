<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Pengeluaran;
use App\Models\Pembayaran;
class MorrisApi extends Controller
{
    public function masuk_keluar()
    {
        $tahun = Carbon::now()->format('Y');
        $dates = [];
        for($i=1;$i<13;$i++):
            $f    = Carbon::create($tahun,$i,1);
            $last = Carbon::create($tahun,$i,1)->addMonth();
            $dates[] = ['awal'=>$f,'akhir'=>$last];
        endfor;
        $data=[];
        $nomor = 1;
        foreach ($dates as $key => $value) {
            $pengeluaran = Pengeluaran::whereBetween('created_at',[$value['awal'],$value['akhir']])->sum('total_biaya');
            $pembayaran = Pembayaran::whereBetween('created_at',[$value['awal'],$value['akhir']])->get();
            $jumlah = 0;
            foreach ($pembayaran as $k => $v) {
                $decode = json_decode($v->json);
                $jumlah+=$decode->jumlah_bayar;
            }
            $data[] = [
                'pengeluaran' => $pengeluaran,
                'pemasukan' => $jumlah,
                'kol' => $nomor.". ".Carbon::parse($value['awal'])->format('d F Y')
            ];
            $nomor++;
        }

        $json  = $data;

        return response()->json($json);
    }
    public function skripi()
    {
        $tahun = Carbon::now()->format('Y');
        $dates = [];
        for($i=1;$i<13;$i++):
            $f    = Carbon::create($tahun,$i,1)->format('Y-m-d');
            $last = Carbon::create($tahun,$i,1)->addMonth()->format('Y-m-d');
            $dates[] = json_decode(json_encode(['awal'=>$f,'akhir'=>$last,'fmt'=> Carbon::create($tahun,$i,1)->format('M Y')]));
        endfor;
        $data = [];
        foreach ($dates as $waktu => $tanggals) {
            $pemeliharaan = Pengeluaran::whereBetween('created_at',[$tanggals->awal,$tanggals->akhir])->where('jenis_pengeluaran','pemeliharaan')->sum('total_biaya');
            $aseting      = Pengeluaran::whereBetween('created_at',[$tanggals->awal,$tanggals->akhir])->where('jenis_pengeluaran','penambahan aset')->sum('total_biaya');
            $fasiliti     = Pengeluaran::whereBetween('created_at',[$tanggals->awal,$tanggals->akhir])->where('jenis_pengeluaran','perbaikan fasilitas')->sum('total_biaya');
            $data[] = [
            
                'pemeliharaan' => $pemeliharaan,
                'assets'       => $aseting,
                'perawatan'    => $fasiliti,
                'd'            => ($waktu+1).". Periode $tanggals->fmt"
            ];
        }
        return response()->json($data);
        
    }
}
