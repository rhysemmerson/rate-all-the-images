<?php

use App\Image;
use Illuminate\Database\Seeder;
use \Illuminate\Support\Arr;

class ImageTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->fromPixabay();
    }

    public function fromPixabay() {
        $response = json_decode(file_get_contents("https://pixabay.com/api/?key=6182439-8173dce4d74e6f73fdefee642&q=cat&category=nature&per_page=15"), true);

        if (!$response) {
            die('Could not retrieve images from pixabay');
        }

        collect($response['hits'])
            ->each(function($image) {
                $file = 'pixabay_' . $image['id'];

                if (strpos($image['webformatURL'], '.jpg') >= 0) {
                    $file .= '.jpg';
                } else if (strpos($image['webformatURL'], '.png') >= 0) {
                    $file .= '.png';
                } else {
                    return;
                }

                /* don't redownload images */
                if (!Storage::disk('local')->exists('public/'.$file)) {
                    printf("Downloading image from pixabay...\n");
                    Storage::disk('local')->put('public/'.$file, file_get_contents(Arr::get($image, 'webformatURL')));
                }

                (new Image([
                    'image_url' => asset($file)
                ]))
                ->save();
            });
    }
}
