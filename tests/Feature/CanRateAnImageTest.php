<?php
/**
 * imgly
 *
 * User: rhys
 * Date: 16/8/17
 * Time: 12:26 PM
 */

namespace Tests\Feature;

use App\Image;
use App\Rating;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CanRateAnImageTest extends TestCase
{
    use DatabaseMigrations;

    public function testUserCanRateImage() {
        // arrange
        $user = factory(User::class)->create();
        $image = factory(Image::class)->create();

        // act
        $response = $this
            ->actingAs($user, 'api')
            ->json('POST', '/ratings', [
                'image_id' => $image['id'],
                'rating' => 1
            ]);

        $ratings = Rating::where([
            'image_id' => $image['id'],
            'user_id' => $user->id
        ]);

        // assert

        $response->assertStatus(200);
        $this->assertEquals(1, $ratings->count());

    }

    public function testUserCannotRateTwice() {
        // arrange
        $user = factory(User::class)->create();
        $image = factory(Image::class)->create();

        // act

        /* attempt to rate the image twice */

        $rating1 = $this
            ->actingAs($user, 'api')
            ->json('POST', '/ratings', [
                'image_id' => $image->id,
                'rating' => 1
            ]);

        $rating2 = $this
            ->actingAs($user, 'api')
            ->json('POST', '/ratings', [
                'image_id' => $image->id,
                'rating' => 1
            ]);

        // assert

        $rating1->assertStatus(200);
        $rating2->assertStatus(400);    // second rating should fail

        $ratings = Rating::where([
            'image_id' => $image->id,
            'user_id' => $user->id
        ]);

        $this->assertEquals(1, $ratings->count());
    }

    public function testUserCannotSeeOthersRatings() {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();
        $ratings = factory(Rating::class, 5)->create([
            'user_id' => $user1->id
        ]);

        /* get ratings as user2 */
        $response = $this->actingAs($user2, 'api')->json('GET', '/ratings');
        $data = $response->json();

        $ratingIds = $ratings->pluck('id');

        $response->assertStatus(200);
        collect($data['data'])
            ->each(function($rating) use($ratingIds) {
                $this->assertNotContains($ratingIds, $rating['id']);
            });
    }
}