<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $type_ids = Type::all()->pluck('id')->all();
        // recupero tutte le categorie e con palck all ottengo non le istanze ma i valori delle proprietà id 
        $technology_id = Technology::all()->pluck('id')->all();
        for ($i = 0; $i < 20; $i++) {

            $pro = new Project();
            $pro->title = $faker->unique()->sentence($faker->numberBetween(3, 10));
            $pro->description = $faker->sentence($faker->numberBetween(20, 100));
            $pro->website_link = 'https://dsdsadsa.com';
            $pro->slug = Str::of($pro->title, '-');
            $pro->type_id = $faker->optional()->randomElement($type_ids);
            $pro->save();

            $pro->technologies()->attach($faker->randomElements($technology_id, rand(0, 4)));
        }
    }
}
