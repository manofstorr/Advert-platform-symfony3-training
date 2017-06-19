<?php

/**
 * Created by PhpStorm.
 * User: David
 * Date: 19/06/2017
 * Time: 21:46
 */



namespace OC\PlatformBundle\Services\Antispam;

class OCAntispam
{
    const MINIMAL_ACCEPTABLE_TEXT_LENGHT = 50;

    public function isSpam(string $text) :bool
    {
        if ($this->isSpamBecauseOfLength($text)) {
            return true;
        }
        return false;
    }

    private function isSpamBecauseOfLength($text) :bool
    {
        return strlen($text) < self::MINIMAL_ACCEPTABLE_TEXT_LENGHT;
    }
}