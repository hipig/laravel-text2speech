<?php

/**
 * Interface StrategyInterface
 */
interface StrategyInterface
{
    /**
     * Apply the strategy and return result.
     *
     * @param array $gateways
     * @return array
     */
    public function apply(array $gateways);
}