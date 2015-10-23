<?php
namespace Ben\Collector;

class TimeCollector
{
    protected $startTime;

    protected $endTime;

    public $id;

    public function prepare()
    {
        $this->startTime = microtime();
    }

    public function finalize()
    {
        $this->endTime = microtime();
    }

    public function getResult()
    {
        return [
            'microtime' => ($this->endTime - $this->startTime),
        ];
    }
}



