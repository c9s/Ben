<?php
namespace Ben\MeasureBase;

/**
 * Measure Base returns an identifier for measuring benchmarks
 */
class OSMeasureBase extends MeasureBase
{
    public function getType()
    {
        return 'os';
    }

    public function getInformation()
    {
        return [
            'os'      => PHP_OS,
            'uname'   => php_uname(),
        ];
    }

    public function getIdentifier()
    {
        return join('-',['os', PHP_OS]);
    }
}


