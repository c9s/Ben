<?php
namespace Ben\Collector;
use Ben\BenchmarkSuite;

class TimeUsageCollector
{
    protected $startTime;

    protected $endTime;

    public $id = 'timer';

    public function prepare()
    {
        $this->startTime = microtime(true);
    }

    public function finalize()
    {
        $this->endTime = microtime(true);
    }

    public function getResult()
    {
        return [
            'duration' => ($this->endTime - $this->startTime),
        ];
    }
}



