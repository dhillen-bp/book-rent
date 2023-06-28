<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // mengosongkan tabel
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            'Comic', 'Fantasy', 'Thriller', 'Mistery', 'Horror', 'Romance'
        ];

        foreach ($data as $value) {
            Category::insert([
                'name' => $value,
                'slug' => strtolower($value)
            ]);
        }
    }
}
