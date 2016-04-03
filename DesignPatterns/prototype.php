<?php

/**
 * 原型模式
 * 
 * @author hiscaler <hiscaler@gmail.com>
 */
class Canvas
{

    public $data;

    public function init($width = 20, $height = 10)
    {
        $data = array();
        for ($i = 0; $i < $height; $i++) {
            for ($j = 0; $j < $width; $j++) {
                $data[$i][$j] = '*';
            }
        }

        $this->data = $data;
    }

    public function draw()
    {
        foreach ($this->data as $line) {
            foreach ($line as $char) {
                echo $char;
            }
            echo "\n";
        }
    }

    public function rect($a1, $a2, $b1, $b2)
    {
        foreach ($this->data as $k1 => $line) {
            if ($k1 < $a1 || $k1 > $a2) {
                continue;
            }
            foreach ($line as $k2 => $char) {
                if ($k2 < $b1 || $k2 > $b2) {
                    continue;
                }
                $this->data[$k1][$k2] = ' ';
            }
        }
    }

}

// Test 
function main()
{
    $prototype = new Canvas();
    $prototype->init();

    $canvas1 = clone $prototype;
    $canvas1->rect(2, 6, 4, 7);
    $canvas1->draw();

    echo "====================================\n";

    $canvas2 = clone $prototype;
    $canvas2->rect(1, 2, 3, 4);
    $canvas2->draw();
}

main();
