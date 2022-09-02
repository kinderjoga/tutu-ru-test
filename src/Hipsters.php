<?php

namespace Tutu\Hipsters;

use function cli\line;
use function Tutu\Treasure\getValue;

/**
 * Runs task Hipsters
 *
 * @return void
 */
function hipsters(): void
{
    $countSmoothe = getValue('Введите количество смузи');
    $countHipsters = getValue('Введите количество Хипстеров');
    $drankSmoothies = distributeSmoothies($countSmoothe, $countHipsters);

    if ($drankSmoothies > 0) {
        $mesage = "{$countHipsters} Хипстеров выпили по {$drankSmoothies} смузи.";
    } else {
        $mesage = "Все {$countSmoothe} смузи пришлось вылить, так как напитков меньше чем Хипстеров.";
    }

    line($mesage);
}

/**
 * Sharing smoothies between hipsters
 * @param int $countSmoothe Count of smoothie to split
 * @param int $countHipsters Count of hipsters among whom it is necessary to divide the smoothie
 *
 * @return int Count of smoothies per one hipster
 */
function distributeSmoothies(int $countSmoothe, int $countHipsters): int
{
    return ($countSmoothe >= $countHipsters) ? intdiv($countSmoothe, $countHipsters) : 0;
}
