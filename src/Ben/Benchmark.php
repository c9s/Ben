<?php
namespace Ben;

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

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function call($n)
    {
        $call = $this->call;
        return $call($n);
    }
}



