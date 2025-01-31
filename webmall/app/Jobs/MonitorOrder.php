<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MonitorOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    //must be higher than the amount of try
    public $tries = 4;

    public $order;
    /**
     * Create a new job instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->order->is_paid) {
            return;
        }

        if ($this->order->created_at->diffInMinutes() > 3) {
            $this->order->markDeclined();
            return;
        }

        // send email notificatioin
        logger()->info('Order gonna delete');

        $this->release(now()->addMinutes(1));
    }
}
