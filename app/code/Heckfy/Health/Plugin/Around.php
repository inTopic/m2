<?php

namespace Heckfy\Health\Plugin;

class Around
{
    public function aroundDivide($calculator, $divide, $x, $y)
    {
        if ($y == 0) {
            return 'Unable to divide';
        }

        $result = $divide($x, $y);
        return 'Around Result is: ' . $result;
    }
}