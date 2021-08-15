<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatalogosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('catalogocab')->insert([
            'id' => 1,
            'tabla' => 'Reglas tabla clients'            
        ]);
        DB::table('catalogodet')->insert([
            'id' => 1,
            'catalogocab_id' => 1,
            'descripcion' => 'SIZE_TOKEN',
            'valorstring' => 'SIZE_TOKEN',
            'valorint' => 20,
            'estado' => 1         
        ]);
        ///////////////////////////////////

        DB::table('catalogocab')->insert([
            'id' => 2,
            'tabla' => 'PAISES'        
        ]);
        DB::table('catalogodet')->insert([
            'id' => 2,
            'catalogocab_id' => 2,
            'descripcion' => 'ECUADOR',
            'valorstring' => 'ECUADOR',
            'estado' => 1         
        ]);
        DB::table('catalogodet')->insert([
            'id' => 3,
            'catalogocab_id' => 2,
            'descripcion' => 'COLOMBIA',
            'valorstring' => 'COLOMBIA',
            'estado' => 1         
        ]);
        DB::table('catalogodet')->insert([
            'id' => 4,
            'catalogocab_id' => 2,
            'descripcion' => 'MEXICO',
            'valorstring' => 'MEXICO',
            'estado' => 1         
        ]);
        //////////////////////////////////

        DB::table('catalogocab')->insert([
            'id' => 3,
            'tabla' => 'STATES'          
        ]);
        DB::table('catalogodet')->insert([
            'id' => 5,
            'catalogocab_id' => 3,
            'descripcion' => 'GUAYAS',
            'valorstring' => 'GUAYAS',
            'valor_bigint' => 2,  
            'estado' => 1         
        ]);
        DB::table('catalogodet')->insert([
            'id' => 6,
            'catalogocab_id' => 3,
            'descripcion' => 'PICHINCHA',
            'valorstring' => 'PICHINCHA',
            'valor_bigint' => 2,  
            'estado' => 1         
        ]);
        DB::table('catalogodet')->insert([
            'id' => 7,
            'catalogocab_id' => 3,
            'descripcion' => 'COL ESTADO 1',
            'valorstring' => 'COL ESTADO 1',
            'valor_bigint' => 3,  
            'estado' => 1         
        ]);
        DB::table('catalogodet')->insert([
            'id' => 8,
            'catalogocab_id' => 3,
            'descripcion' => 'COL ESTADO 2',
            'valorstring' => 'COL ESTADO 2',
            'valor_bigint' => 3,  
            'estado' => 1         
        ]);
        DB::table('catalogodet')->insert([
            'id' => 9,
            'catalogocab_id' => 3,
            'descripcion' => 'MEX ESTADO 1',
            'valorstring' => 'MEX ESTADO 1',
            'valor_bigint' => 4,  
            'estado' => 1         
        ]);
        DB::table('catalogodet')->insert([
            'id' => 10,
            'catalogocab_id' => 3,
            'descripcion' => 'MEX ESTADO 2',
            'valorstring' => 'MEX ESTADO 2',
            'valor_bigint' => 4,  
            'estado' => 1         
        ]);

        //////////////////////////////////
        DB::table('catalogocab')->insert([
            'id' => 4,
            'tabla' => 'CIUDADES'          
        ]);
        DB::table('catalogodet')->insert([
            'id' => 11,
            'catalogocab_id' => 4,
            'descripcion' => 'GUAYAQUIL',
            'valorstring' => 'GUAYAQUIL',
            'valor_bigint' => 5,  
            'estado' => 1         
        ]);
        DB::table('catalogodet')->insert([
            'id' => 12,
            'catalogocab_id' => 4,
            'descripcion' => 'SAMBORONDON',
            'valorstring' => 'SAMBORONDON',
            'valor_bigint' => 5,  
            'estado' => 1         
        ]);
        DB::table('catalogodet')->insert([
            'id' => 13,
            'catalogocab_id' => 4,
            'descripcion' => 'QUITO',
            'valorstring' => 'QUITO',
            'valor_bigint' => 6,  
            'estado' => 1         
        ]);
        DB::table('catalogodet')->insert([
            'id' => 14,
            'catalogocab_id' => 4,
            'descripcion' => 'SANGOLQUI',
            'valorstring' => 'SANGOLQUI',
            'valor_bigint' => 6,  
            'estado' => 1         
        ]);
        DB::table('catalogodet')->insert([
            'id' => 15,
            'catalogocab_id' => 4,
            'descripcion' => 'BOGOTA',
            'valorstring' => 'BOGOTA',
            'valor_bigint' => 7,  
            'estado' => 1         
        ]);
        DB::table('catalogodet')->insert([
            'id' => 16,
            'catalogocab_id' => 4,
            'descripcion' => 'CALI',
            'valorstring' => 'CALI',
            'valor_bigint' => 8,  
            'estado' => 1         
        ]);
        DB::table('catalogodet')->insert([
            'id' => 17,
            'catalogocab_id' => 4,
            'descripcion' => 'GUADALAJARA',
            'valorstring' => 'GUADALAJARA',
            'valor_bigint' => 9,  
            'estado' => 1         
        ]);
        DB::table('catalogodet')->insert([
            'id' => 18,
            'catalogocab_id' => 4,
            'descripcion' => 'ACAPULCO',
            'valorstring' => 'ACAPULCO',
            'valor_bigint' => 10,  
            'estado' => 1         
        ]);
    }
}
