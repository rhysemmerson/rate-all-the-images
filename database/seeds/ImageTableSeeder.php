<?php

use App\Image;
use Illuminate\Database\Seeder;
use \Illuminate\Support\Arr;

class ImageTableSeeder extends Seeder
{
    public $importFile = 'data/pixabay_landscapes.json';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->fromPixabay($this->importFile);
    }

    public function fromPixabay($file) {
        $response = json_decode(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . $file), true);

        collect($response['hits'])
            ->each(function($image) {
                (new Image([
                    'image_url' => Arr::get($image, 'webformatURL')
                ]))
                ->save();
            });
    }
}
