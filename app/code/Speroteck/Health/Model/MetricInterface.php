<?php

namespace Speroteck\Health\Model;

/**
 * Interface MetricInterface
 *
 * @package Speroteck\Health\Model
 */
interface MetricInterface
{
    /**
     * get metric value
     *
     * @return string
     */
    function getValue();

    /**
     * get metric status
     *
     * @return string
     */
    function isActive();

    /**
     * get metric name
     *
     * @return string
     */
    function getName();

    /**
     * get metric code
     *
     * @return string
     */
    function getCode();
}