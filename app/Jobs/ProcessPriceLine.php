<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class ProcessPriceLine implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $priceLine;

    /**
     * ProcessPriceLine constructor.
     * @param $priceLine
     */
    public function __construct($priceLine)
    {
        $this->priceLine = $priceLine;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        echo $this->priceLine . "\n";
    }
}
