<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ResumeRepository")
 */
class Resume
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ResumeTranslation", mappedBy="resume", cascade={"persist","remove"})
     */
    private $resumeTranslations;

    public function __construct()
    {
        $this->resumeTranslations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection|ResumeTranslation[]
     */
    public function getResumeTranslations(): Collection
    {
        return $this->resumeTranslations;
    }

    public function addResumeTranslation(ResumeTranslation $resumeTranslation): self
    {
        if (!$this->resumeTranslations->contains($resumeTranslation)) {
            $this->resumeTranslations[] = $resumeTranslation;
            $resumeTranslation->setResume($this);
        }

        return $this;
    }

    public function removeResumeTranslation(ResumeTranslation $resumeTranslation): self
    {
        if ($this->resumeTranslations->contains($resumeTranslation)) {
            $this->resumeTranslations->removeElement($resumeTranslation);
            // set the owning side to null (unless already changed)
            if ($resumeTranslation->getResume() === $this) {
                $resumeTranslation->setResume(null);
            }
        }

        return $this;
    }

    public function getTranslation(string $locale)
    {
        return $this->resumeTranslations
            ->filter(function ($translation) use ($locale){
                /** @var ResumeTranslation $translation */
                return $translation->getLocale() == $locale;
            })
            ->first();
    }
}
