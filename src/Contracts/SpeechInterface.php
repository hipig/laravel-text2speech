<?php

namespace Hipig\LaravelTts\Contracts;

/**
 * Interface SpeechInterface
 */
interface SpeechInterface
{
    /**
     * Get speed.
     *
     * @return string|null
     */
    public function getSpd();

    /**
     * Get pitch.
     *
     * @return string|null
     */
    public function getPit();

    /**
     * Get volume.
     *
     * @return string|null
     */
    public function getVol();

    /**
     * Get per.
     *
     * @return string
     */
    public function getPer();

    /**
     * Get aue.
     *
     * @return string|null
     */
    public function getAue();

    /**
     * Set speed.
     *
     * @param string $spd
     * @return $this
     */
    public function setSpd(string $spd);

    /**
     * Set pitch.
     *
     * @param string $pit
     * @return $this
     */
    public function setPit(string $pit);

    /**
     * Set volume.
     *
     * @param string $vol
     * @return $this
     */
    public function setVol(string $vol);

    /**
     * Set per.
     *
     * @param string $per
     * @return $this
     */
    public function setPer(string $per);

    /**
     * Set aue.
     *
     * @param string $aue
     * @return $this
     */
    public function setAue(string $aue);

    /**
     * Return speech supported gateways.
     *
     * @return array
     */
    public function getGateways();
}