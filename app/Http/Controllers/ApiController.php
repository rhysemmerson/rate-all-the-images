<?php
/**
 * imgly
 *
 * User: rhys
 * Date: 16/8/17
 * Time: 2:31 PM
 */

namespace App\Http\Controllers;


use App\Image;
use Illuminate\Http\Request;
use App\User;
use App\Rating;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function ratingsGet() {
        $user = \Auth::user();

        $response = [
            'data' => $user->ratings()->with('image')->orderby('created_at', 'desc')->get()
        ];

        return response()->json($response);
    }

    public function ratingsPost(Request $request) {
        $user = \Auth::user();

        $imageId = $request->json('image_id');
        $ratingVal = $request->json('rating');

        if ($ratingVal === null) {
            return response()
                    ->json([
                        'error' => 'rating is required'
                    ])
                    ->setStatusCode(400);
        }

        if ($user->ratings()->where('image_id', $imageId)->exists()) {
            return response()
                    ->json([
                        'error' => 'image has already been rated by user'
                    ])
                    ->setStatusCode('400');
        }

        $rating = new Rating();
        $rating->user_id = \Auth::id();
        $rating->rating = $ratingVal;
        $rating->image_id = $imageId;

        $rating->save();

        return response($rating);
    }

    public function imagesRandomGet() {
        $user = \Auth::user();

        $imageIds = Image::whereNotIn(
            'id',
            $user->ratings()->get()->pluck('image_id')->toArray()
        )->pluck('id');

        if ($imageIds->isEmpty()) {
            return response()
                ->json([
                    'error' => 'no-more-images',
                    'message' => "Congratulations! you have rated all the images"
                ]);
        }

        /* get a random image */
        $image = Image::find($imageIds->random());

        return response()->json($image);
    }

}