<?php


namespace App\Service\SettingsHandler;


use App\Entity\Settings;
use Doctrine\ORM\EntityManagerInterface;

class SettingsHandler implements SettingsHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createSettings(Settings $settings): void
    {
        if ($settings) {
            $this->entityManager->persist($settings);
            $this->entityManager->flush();
        }
    }

    public function updateSettings(Settings $settings): void
    {
        $this->entityManager->persist($settings);
        $this->entityManager->flush();
    }

    public function deleteSettings(Settings $settings): void
    {
        $this->entityManager->remove($settings);
        $this->entityManager->flush();
    }

    public function showSettings(): ?array
    {
        return $this->entityManager->getRepository(Settings::class)->findAll();
    }


}