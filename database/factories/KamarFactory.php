<?php

namespace Database\Factories;

use App\Models\Kamar;
use Illuminate\Database\Eloquent\Factories\Factory;

class KamarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Kamar::class;

    /**
     * Define the model's default state.
     *
     * @return array
      * SELECT * FROM ARSIP
      
    
     */

    public function definition()
    {
        $data = $this->model;
        $last = $data::orderBy('id','DESC')->first();
        
        $nomor = ($last==NULL?0:intval($last->nomor));
        $nomor = intval($nomor)+1;
        echo "$nomor\n";
        return [
            'nomor'=>sprintf('%03d',$nomor),
            'harga'=>300000,
            'status'=>'ready',
        ];
    }
}
