<?php
/**
 * imgly
 *
 * User: rhys
 * Date: 16/8/17
 * Time: 2:31 PM
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function ratingsGet() {
        $user = Auth::user();

        $response = $user->ratings();

        return response()->json($response);
    }

    public function ratingsPost(Request $request) {

        $rating = new Rating();
        $rating->user_id = Auth::id();
        $rating->rating = $request->input('rating');
    }

    public function imagesRandomGet() {

    }

}