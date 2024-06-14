<?php

namespace Database\Seeders;

use App\Models\Type;
use App\functions\Helper;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types=json_decode(file_get_contents(__DIR__ . '/types.json'));

        foreach($types as $type){
            $new_type= new Type ();

            $new_type->name = $type->name;
            $new_type->slug = Helper::generateSlug($new_type->name, new Type());
            $new_type->image = $type->image;
            $new_type->save();




        }
    }
}
