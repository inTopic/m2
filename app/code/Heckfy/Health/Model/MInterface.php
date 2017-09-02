<?php

namespace Heckfy\Health\Model;

interface MInterface
{
    function getMetricValue();
    function isActive();
}