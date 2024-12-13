<?php
namespace App\Events;

use App\Models\Seguimiento;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class RegistroActualizado implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $seguimiento;

    public function __construct(Seguimiento $seguimiento)
    {
        $this->seguimiento = $seguimiento;
    }

    public function broadcastOn()
    {
        return new Channel('seguimientos');
    }
}
