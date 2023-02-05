<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'tag' => '家事'
        ];
        Tag::create($param);
        $param = [
            'tag' => '勉強'
        ];
        Tag::create($param);
        $param = [
            'tag' => '運動'
        ];
        Tag::create($param);

        $param = [
            'tag' => '食事'
        ];
        Tag::create($param);
        $param = [
            'tag' => '移動'
        ];
        Tag::create($param);
    }
}
