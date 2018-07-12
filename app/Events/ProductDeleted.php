<?php

namespace App\Events;

use App\Product;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ProductDeleted implements ShouldBroadcast
{
	use Dispatchable, InteractsWithSockets, SerializesModels;

	/**
	 * @var Product
	 */
	public $product;

	/**
	 * Create a new event instance.
	 *
	 * @param Product $product
	 */
	public function __construct(Product $product)
	{
		$this->product = $product;
	}

	public function broadcastWith () {
		return [
			"id" => $this->product->id
		];
	}

	/**
	 * Get the channels the event should broadcast on.
	 *
	 * @return \Illuminate\Broadcasting\Channel|array
	 */
	public function broadcastOn()
	{
		return new Channel('product-deleted');
	}
}

