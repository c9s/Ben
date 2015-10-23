<?php
namespace Ben;
use Ben\Benchmark;

class BenchmarkSuite
{
    public $benchmarks = array();

    public $N = 50000;

    public function __construct()
    {
    
    }

    public function add(Benchmark $benchmark)
    {
        $this->benchmark[] = $benchmark;
    }

    public function setN($N)
    {
        $this->N = $N;
    }
}


