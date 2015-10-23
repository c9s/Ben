<?php
namespace Ben\ResultRenderer;
use Ben\BenchmarkSuite;

class TextBarRenderer
{
    public function render(BenchmarkSuite $suite, array $result, $key, callable $calculator = null)
    {
        echo $suite->title, PHP_EOL;
        echo str_repeat("=", strlen($suite->title)), PHP_EOL, PHP_EOL;


        $columnLength = array();
        $maxColumnLength = 0;
        $max = 0;
        $keys = array_keys($result['benchmark']);

        foreach ($result['benchmark'] as $n => $measure) {
            $columnLength[ $n ] = strlen($n) + 1;
            if (strlen($n) > $maxColumnLength) {
                $maxColumnLength = strlen($n);
            }

            $val = $measure[$key];
            if ($calculator) {
                $val = $calculator($suite, $val);
            }
            if ($val > $max) {
                $max = $val;
            }
        }

        printf("  % ". $maxColumnLength ."s | " , 'task');
        printf("%8s", 'rate');
        echo " | ";
        echo "\n";

        foreach ($result['benchmark'] as $n => $measure) {
            // foreach ($names as $name1) {
            // $task1 = $this->tasks[ $name1 ];
            printf("  % ". $maxColumnLength ."s | " , $n );

            $val = $measure[$key];
            if ($calculator) {
                $val = $calculator($suite, $val);
            }
            printf("%8.3f", $val);

            echo " | ";

            $r = ($val / $max);
            $w = 60;
            $chars = (int) ($w * $r);
            echo str_repeat( '█' , $chars );
            # echo str_repeat( '=' , $chars - 1 );
            # echo ">";
            echo str_repeat( ' ' , $w - $chars );
            echo "  |";
            echo "\n";
        }
    }
}




