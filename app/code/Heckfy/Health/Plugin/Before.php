<?php

namespace Heckfy\Health\Plugin;

class Before
{
    public function beforeDivide($calculator, $x, $y)
    {
        echo 'before plugin | ';
        return [6,2];
    }
}