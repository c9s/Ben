<?php
namespace Ben;
use Ben\Benchmark;

class BenchmarkSuite
{
    public $benchmarks = array();

    public $N = 50000;

    public function add(Benchmark $benchmark)
    {
      $this->benchmarks[$benchmark->getName()] = $benchmark;
    }

    public function setN($N)
    {
        $this->N = $N;
    }
}


