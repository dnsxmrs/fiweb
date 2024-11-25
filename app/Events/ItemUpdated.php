<?php

namespace App\Events;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ItemUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $item;
    /**
     * Create a new event instance.
     */
    public function __construct(Product $item) // category lang as default
    {
        //
        $this->item = $item;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('item_updates'),
        ];
    }
}
