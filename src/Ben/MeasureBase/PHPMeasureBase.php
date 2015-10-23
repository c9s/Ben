<?php
namespace Ben\MeasureBase;

/**
 * Measure Base returns an identifier for measuring benchmarks
 */
class PHPMeasureBase extends MeasureBase
{
    public function getInformation()
    {
        return [
            'type'    => 'php',
            'os'      => PHP_OS,
            'version' => phpversion(),
            'uname'   => php_uname(),
            'features' => [
                'opcache_enabled' => extension_loaded('opcache'),
                'gc_enabled' => gc_enabled(),
            ],
        ];
    }

    public function getIdentifier()
    {
        return join('-',['php', phpversion(), PHP_OS]);
    }
}


