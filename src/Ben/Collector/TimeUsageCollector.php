<?php
namespace Ben\Collector;
use Ben\BenchmarkSuite;

class TimeUsageCollector implements Collector
{
    protected $startTime;

    protected $endTime;

    public function getId()
    {
        return 'timer';
    }


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



