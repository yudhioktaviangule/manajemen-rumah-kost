<?php

namespace App\Http\Controllers\Api;

use App\BusinessLogic\BLPengeluaran;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use App\Models\Penyewa;
use Carbon\Carbon;
class DashboardApi extends Controller
{
    public function __construct() {
        
    }
    public function kamar()
    {
        $kamar = Kamar::get();
        $kosong = 0;
        $terisi = 0;
        $jumlah_kamar = count($kamar);
        foreach ($kamar as $key => $value) {
            if($value->status=='disewa'):
                $terisi++;
            else:
                $kosong++;
            endif;
        }
        $json = [
            'jumlah' => $jumlah_kamar,
            'kosong' => $kosong,
            'terisi' => $terisi,

        ];
        return response()->json($json);

    }
    public function money(){
        $keluar = new BLPengeluaran();

        
        $keuntungan = 0;
        $pengeluaran = 0;
        $tanggalAwal = Carbon::now()->firstOfMonth()->format('Y-m-d');
        $tanggalAkhir = Carbon::now()->lastOfMonth()->format('Y-m-d');
        $pembayaran = Pembayaran::whereBetween('created_at',[$tanggalAwal,$tanggalAkhir])->sum('pembayaran');
        $pengeluaran = $keluar->getPengeluaran([$tanggalAwal,$tanggalAkhir]);
        $keuntungan = $pembayaran-$pengeluaran;
        $json = [
            'tanggal_filter'=>[
                'awal' => $tanggalAwal,
                'terakhir' => $tanggalAkhir,
            ],
            'pemasukan' => $pembayaran,
            'pengeluaran' => $pengeluaran,
            'keuntungan' => $keuntungan>0? $keuntungan : 0,
        ];
        return response()->json($json);
    }

    public function moneyMasuk(Request $request)
    {
        $tanggalAwal = $request->awal;
        $tanggalAkhir = $request->akhir;
        $tunai = Pembayaran::where('metode','tunai')->whereBetween('created_at',[$tanggalAwal,$tanggalAkhir])->sum('pembayaran');
        $tf = Pembayaran::where('metode','transfer')->whereBetween('created_at',[$tanggalAwal,$tanggalAkhir])->sum('pembayaran');
        $response = ['tunai'=>$tunai,'transfer'=>$tf];
        return response()->json($response);
    }

    private function penghuniAktif($jk='laki-laki')
    {
        $penyewa = Penyewa::whereIn('id',function($q){
                    $q->select('penyewa_id')->from('users')->where('aktif','aktif');
                })
                ->where('jenis_kelamin',$jk)
                ->count();
        return $penyewa;
    }

    public function huni()
    {
        $l = $this->penghuniAktif('laki-laki');        
        $p = $this->penghuniAktif('perempuan');        
        $json = ['data'=>[$l,$p]];
        return response()->json($json);
    }

    private function penghuni($awal,$akhir)
    {
        $data = Penyewa::whereBetween('created_at',[$awal,$akhir])
                    ->whereIn('id',function($q){
                        $q->select('penyewa_id')->from('users')
                        ->where('aktif','aktif')
                        ->orWhere('aktif','checkout');
                    })->count();
        return $data;
    }


    public function daftarHuniBulanan()
    {
        $awal = Carbon::now()->firstOfYear();
        
        $bulan = 1;
        $dbl = [];
        while($bulan<13){
            $xawal = $awal->firstOfMonth();
            $bulanAwal = $xawal->firstOfMonth()->format('Y-m-d');
            $bulanAkhir = $xawal->lastOfMonth()->format('Y-m-d');
            $dbl[] = $this->penghuni($bulanAwal,$bulanAkhir);
            $awal = $awal->firstOfMonth()->addMonth(1);
            $bulan++;
        }
        $json=$dbl;
        return response()->json($json);
    }
}
