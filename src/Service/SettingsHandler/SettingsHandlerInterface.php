<?php


namespace App\Service\SettingsHandler;


use App\Entity\Settings;

interface SettingsHandlerInterface
{
    /**
     * @param Settings $settings
     */
    public function createSettings(Settings $settings): void ;

    /**
     * @param Settings $settings
     */
    public function updateSettings(Settings $settings): void ;

    /**
     * @param Settings $settings
     */
    public function deleteSettings(Settings $settings): void ;
}