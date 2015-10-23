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

    public function getResult(BenchmarkSuite $suite)
    {
        $milliseconds = ($this->endTime - $this->startTime) * 1000;
        return [
            'duration' => $milliseconds,
            'rate' => $suite->N / $milliseconds,
        ];
    }
}



