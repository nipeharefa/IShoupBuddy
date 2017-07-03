<?php

namespace App\Observers;

use App\Models\Review;
use App\Events\ReviewCreated;
use App\Events\ReviewUpdated;
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
            event($review);
        } catch (Exception $e) {}
    }

    public function updated(Review $review)
    {
        try {
            $review = new ReviewUpdated($review);
            event($review);

        } catch (Exception $e) {

        }
    }
}
