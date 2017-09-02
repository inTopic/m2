<?php

namespace Heckfy\Health\Plugin;

class After
{
    public function afterDivide($calculator, $result)
    {
        echo 'The result is: ' , $result;
    }
}