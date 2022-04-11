<?php

namespace ExAdmin\ui\traits;

use ExAdmin\ui\Route;
use ExAdmin\ui\exception\DelayedException;
use Illuminate\Support\Facades\Log;


trait Delayed
{
    protected function lazyLoad(){
        $backtraces = $this->getBacktraces();
        Log::error($backtraces);
        if(isset($backtraces[2])){
            $backtrace = $backtraces[2];
            if($backtrace['function'] =='invokeMethod' &&  $backtrace['class'] == Route::class){
                return false;
            }
        }
        $e = new DelayedException();
        $e->create($this);
        throw new $e;
    }
}
