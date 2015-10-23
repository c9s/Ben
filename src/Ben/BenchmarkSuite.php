<?php
namespace Ben;
use Ben\Benchmark;

class BenchmarkSuite
{
    public $benchmarks = array();

    public $N = 50000;

    public $name;

    public $title;

    public function __construct($name, $title = null)
    {
        $this->name = $name;
        $this->title = $title;
    }

    public function add(Benchmark $benchmark)
    {
      $this->benchmarks[$benchmark->getName()] = $benchmark;
    }

    public function setN($N)
    {
        $this->N = $N;
    }
}


