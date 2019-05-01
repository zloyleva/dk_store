<?php

namespace App\Jobs;

use App\Services\ReadPrice\ReadPrice;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class ParsePrice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $readPrice;

    /**
     * ParsePrice constructor.
     * @param ReadPrice $readPrice
     */
    public function __construct(ReadPrice $readPrice)
    {
        $this->readPrice = $readPrice;
    }

    /**
     * @throws \Exception
     */
    public function handle()
    {
        if($this->readPrice->isPriceExist()){
            Log::info("Start reading");
            foreach ($this->readPrice->getPriceLines() as $line){
                ProcessPriceLine::dispatch($line);
            }
        }else{
            Log::error("Can't find file " . $this->readPrice->getPriceFullPath());
        }
    }
}
