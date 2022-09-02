<?php

namespace Tutu\Treasure;

use function cli\line;
use function cli\prompt;

/**
 * Runs task Treasure
 *
 * @return void
 */
function takeTreasure(): void
{
    $maxM = getValue('Введите массу, которую вы в состоянии унести');
    $stones = getStones();
    $oneStone = takeOneStone($maxM, $stones);
    $manyStones = takeManyStones($maxM, $stones);

    line("Если можно взять не более одного камня каждого типа, то максимальная выручка: {$oneStone}");
    line("Если можно взять сколько угодно камней каждого типа, то максимальная выручка: {$manyStones}");
}

/**
 * Calculates profit according to scenario No. 1
 * @param int $maxM Make maximum
 * @param array $stones Stones stack
 *
 * @return int Price maked stones
 */

function takeOneStone(int $maxM, array $stones): int
{
    $result = 0;
    for ($i = 0; $i < count($stones); $i++) {
        $param1 = 'stonePrice' . ($i + 1);
        $param2 = 'stoneWeight' . ($i + 1);
        $$param1 = $stones[$i]['price'];
        $$param2 = $stones[$i]['weight'];
    }

    if ($maxM < $stoneWeight1 && $maxM < $stoneWeight2) {
        $result = 0;
    } elseif ($maxM >= $stoneWeight1 && $maxM < $stoneWeight2) {
        $result = $stonePrice1;
    } elseif ($maxM >= $stoneWeight2 && $maxM < $stoneWeight1 + $stoneWeight2) {
        $result = $stonePrice2;
    } else {
        $result = $stonePrice1 + $stonePrice2;
    }
    return $result;
}

/**
 * Calculates profit according to scenario No. 2
 * @param int $maxM Make maximum
 * @param array $stones Stones stack
 *
 * @return int price Maked stones
 */
function takeManyStones(int $maxM, array $stones): int
{
    for ($i = 0; $i < count($stones); $i++) {
        $param1 = 'stonePrice' . $i + 1;
        $param2 = 'stoneWeight' . $i + 1;
        $$param1 = $stones[$i]['price'];
        $$param2 = $stones[$i]['weight'];
    }

    $countStones1 = intdiv($maxM, $stoneWeight1);
    $weightOnlyStones1 = $stoneWeight1 * $countStones1;

    $countStones2 = intdiv($maxM, $stoneWeight2);
    $weightOnlyStones2 = $stoneWeight2 * $countStones2;

    $countRestWeight1 = intdiv($maxM - $weightOnlyStones1, $stoneWeight2);
    $countRestWeight2 = intdiv($maxM - $weightOnlyStones2, $stoneWeight1);

    $result1 = $countStones1 * $stonePrice1 + $countRestWeight1 * $stonePrice2;
    $result2 = $countStones2 * $stonePrice2 + $countRestWeight2 * $stonePrice1;

    return max($result1, $result2);
}

/**
 * Return array stones ['price' => $price, 'weight' => $weight]
 * @return array Stones stack
 *
 * Array is sorted by weight
 */
function getStones(): array
{
    $result = [];
    for ($i = 1; $i < 3; $i++) {
        $price = getValue("Введите стоимость камня {$i}");
        $weight = getValue("Введите массу камня {$i}");
        $result[] = ['price' => $price, 'weight' => $weight];
    }
    usort($result, function ($a, $b) {
        return $a['weight'] <=> $b['weight'];
    });
    return $result;
}

/**
 * Function prints a message when a value is entered and returns the input value
 * @param string $mesage Displayed message
 * @return int Entered value
 */
function getValue(string $mesage): int
{
    $result = -1;
    while (!(is_numeric($result) && $result > 0)) {
        $result = prompt($mesage);
    }
    return $result;
}
