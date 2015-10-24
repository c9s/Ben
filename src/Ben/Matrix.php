<?php
namespace Ben;
use ArrayAccess;


class Matrix implements ArrayAccess
{
    protected $matrix;

    public function __construct(array $matrix)
    {
        $this->matrix = $matrix;
    }

    public function getColumnNames()
    {
        reset($this->matrix);
        $firstRow = current($this->matrix);
        return array_keys($firstRow);
    }

    public function getRowLabels()
    {
        return array_keys($this->matrix);
    }

    
    public function offsetSet($name,$value)
    {
        $this->matrix[ $name ] = $value;
    }
    
    public function offsetExists($name)
    {
        return isset($this->matrix[ $name ]);
    }
    
    public function offsetGet($name)
    {
        return $this->matrix[ $name ];
    }
    
    public function offsetUnset($name)
    {
        unset($this->matrix[$name]);
    }

    public function toArray()
    {
        return $this->matrix;
    }

    public function apply(callable $apply)
    {
        foreach ($this->matrix as $row) {
            foreach ($row as $column => & $value) {
                $apply($value);
            }
        }
    }

}




