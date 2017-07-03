<?php

namespace App\Observers;

use App\Models\Review;
use App\Events\ReviewCreated;
use Exception;
use Log;

class ReviewObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function created(Review $review)
    {
        try {

            $review = new ReviewCreated($review);

        } catch (Exception $e) {

        }
    }
}
