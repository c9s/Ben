<?php
namespace Ben;
use Ben\BenchmarkRunner;

class Benchmark
{
    protected $name;

    protected $title;

    protected $call;

    public function __construct($name, callable $call)
    {
        $this->name = $name;
        $this->call = $call;
    }

    public function getName()
    {
        return $this->name;
    }


    public function getTitle()
    {
        return $this->title;
    }


    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function call($n, BenchmarkRunner $runner)
    {
        $call = $this->call;
        return $call($n, $runner);
    }
}



