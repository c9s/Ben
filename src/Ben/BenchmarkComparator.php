<?php
namespace Ben;
use Ben\BenchmarkSuite;

/**
 * BenchmarkComparator
 *
 * Compare benchmarks in the same benchmark suite.
 */
class BenchmarkComparator
{

    public function compare(BenchmarkSuite $suite, Array $result, $key, callable $calculator = null)
    {
        // return comparison matrix
        // $benchmarkNames = array_intersect_key($a['benchmark'], $b['benchmark']);
        $namesA = array_keys($result['benchmark']);
        $namesB = array_keys($result['benchmark']);
        $matrix = [];
        foreach ($namesA as $nameA) {
            foreach ($namesB as $nameB) {
                $measureA = $result['benchmark'][$nameA];
                $measureB = $result['benchmark'][$nameB];

                if (!isset($measureA[$key]) || !isset($measureB[$key])) {
                    continue;
                }
                if ($calculator) {
                    $matrix[$nameA][$nameB] = $calculator($measureA, $measureB);
                } else {
                    $matrix[$nameA][$nameB] = $measureA[$key] / $measureB[$key];
                }
            }
        }
        return $matrix;
    }
}



