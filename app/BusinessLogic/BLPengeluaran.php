<?php
namespace App\BusinessLogic;

use App\Models\Pengeluaran;

class BLPengeluaran{
    private $model;
    public function __construct() {
        $this->model = Pengeluaran::class;
    }
    public function getPengeluaran($periode = [])
    {
        $pengeluaran = $this->model::whereBetween("tanggal",$periode)->sum("nominal");
        return $pengeluaran;
    }
    public function getAllPengeluaran()
    {
        $pengeluaran = $this->model::sum("nominal");
        return $pengeluaran;
    }
}