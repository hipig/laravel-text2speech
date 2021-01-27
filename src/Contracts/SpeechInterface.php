<?php

/**
 * Interface SpeechInterface
 */
interface SpeechInterface
{
    /**
     * Get speed.
     *
     * @param GatewayInterface|null $gateway
     * @return string
     */
    public function getSpd(GatewayInterface $gateway = null) :string;

    /**
     * Get pitch.
     *
     * @param GatewayInterface|null $gateway
     * @return string
     */
    public function getPit(GatewayInterface $gateway = null) :string;

    /**
     * Get volume.
     *
     * @param GatewayInterface|null $gateway
     * @return string
     */
    public function getVol(GatewayInterface $gateway = null) :string;

    /**
     * Get per.
     *
     * @param GatewayInterface|null $gateway
     * @return string
     */
    public function getPer(GatewayInterface $gateway = null) :string;

    /**
     * Get aue.
     *
     * @param GatewayInterface|null $gateway
     * @return string
     */
    public function getAue(GatewayInterface $gateway = null) :string;
}