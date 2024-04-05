<?php

namespace App\Events\Signature;

use App\Models\ContractCondominia;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SetSignatureContract
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    private ContractCondominia $contract;
    /**
     * Create a new event instance.
     */
    public function __construct(
        ContractCondominia $contract
    )
    {
        $this->contract = $contract;
        logger('Estou no construct do event '.$this->contract);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
