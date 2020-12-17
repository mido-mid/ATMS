<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class headnotifications
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $request_id;
    public $employee_name;
    public $checkout_time;
    public $status;
    public $date;
    public $time;
    public $employee_department;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data = [])
    {
        //
        $this->request_id = $data['request_id'];
        $this->checkout_time = $data['checkout_time'];
        $this->status = $data['status'];
        $this->employee_name = $data['employee_name'];
        $this->employee_department = $data['employee_department'];
        $this->date = date("Y-m-d", strtotime(Carbon::now()));
        $this->time = date("h:i A", strtotime(Carbon::now()));
    }

    /**
     * Determine if this event should broadcast.
     *
     * @return bool
     */
    public function broadcastWhen()
    {
        return auth()->user()->type == 1 && auth()->user()->department->id == $this->employee_department;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['headnotifications'];
    }
}
