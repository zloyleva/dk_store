<?php

namespace App\Services\ReadPrice;

use Illuminate\Support\Facades\Storage;

class ReadPrice {

    /**
     * @return bool
     */
    public function isPriceExist():bool
    {
        return Storage::exists(config('app_custom.price.price_path'));
    }

    /**
     * @return string
     */
    public function getPriceFullPath(): string
    {
        return storage_path("app/" . config('app_custom.price.price_path'));
    }

    /**
     * @return \Generator
     * @throws \Exception
     */
    public function getPriceLines():\Generator
    {
        $file = $this->getPriceFullPath();
        $f = fopen($file, 'r');
        if (!$f) throw new \Exception("Can't read file: ${$file}");
        while ($line = fgets($f)) {
            yield $line;
        }
        fclose($f);
    }
}
