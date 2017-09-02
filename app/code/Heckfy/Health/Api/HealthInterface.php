<?php
namespace Heckfy\Health\Api;

interface HealthInterface
{
    /**
     * Get status if everybody is ok
     *
     * @api
     *
     * @return string
     */
    public function getStatus();

    /**
     * Show information
     *
     * @api
     *
     * @return string Greeting message
     */
    public function health();

    /**
     * Run all metrics
     *
     * @api
     *
     * @return string Greeting message
     */
    public function run();
}