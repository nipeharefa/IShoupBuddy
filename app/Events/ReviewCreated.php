<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Review;
use App\Models\User;
use App\Models\Product;
use App\Helpers\Traits\Sentimen as SentimenTrait;
use App\Helpers\Traits\ScoreReviewOnEvents;

class ReviewCreated implements ShouldBroadcast
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
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return [
            new PrivateChannel('review.product.'.$this->product->id),
            new PrivateChannel('review.product_vendor.'.$this->productVendor->id)
        ];
    }
}
