<?php

namespace App\Events;

use App\Helpers\Traits\ScoreReviewOnEvents;
use App\Helpers\Traits\Sentimen as SentimenTrait;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReviewUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets,
        SerializesModels, SentimenTrait,
        ScoreReviewOnEvents;

    protected $product;

    protected $productVendor;

    protected $user;

    protected $reviewModel;

    public $review;

    public $summaryProductVendor;

    public $summaryProduct;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Review $review)
    {
        $this->reviewModel = $review;
        $this->product = $review->Product;
        $this->productVendor = $review->ProductVendor;
        $this->review = transform($review);
        $this->mapReview();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return [
            new Channel('review.product.'.$this->product->id),
            new Channel('review.product_vendor.'.$this->productVendor->id),
        ];
    }

    public function broadcastAs()
    {
        return 'review.updated';
    }
}
