<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AfterSessionRegenerated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $old;
    public string $current;

    public function __construct(string $old, string $current)
    {
        $this->old = $old;
        $this->current = $current;
    }
}
