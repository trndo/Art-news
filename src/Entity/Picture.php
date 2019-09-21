<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PictureRepository")
 */
class Picture
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
     * @ORM\OneToMany(targetEntity="App\Entity\PictureTranslation", mappedBy="picture", cascade={"persist","remove"})
     */
    private $pictureTranslations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Photo", mappedBy="picture", cascade={"persist","remove"})
     */
    private $photos;

    /**
     * @ORM\Column(type="integer", nullable=true, unique=true)
     */
    private $sliderPosition;

    public function __construct()
    {
        $this->pictureTranslations = new ArrayCollection();
        $this->photos = new ArrayCollection();
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
     * @return Collection|PictureTranslation[]
     */
    public function getPictureTranslations(): Collection
    {
        return $this->pictureTranslations;
    }

    public function addPictureTranslation(PictureTranslation $pictureTranslation): self
    {
        if (!$this->pictureTranslations->contains($pictureTranslation)) {
            $this->pictureTranslations[] = $pictureTranslation;
            $pictureTranslation->setPicture($this);
        }

        return $this;
    }

    public function removePictureTranslation(PictureTranslation $pictureTranslation): self
    {
        if ($this->pictureTranslations->contains($pictureTranslation)) {
            $this->pictureTranslations->removeElement($pictureTranslation);
            // set the owning side to null (unless already changed)
            if ($pictureTranslation->getPicture() === $this) {
                $pictureTranslation->setPicture(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Photo[]
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setPicture($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photos->contains($photo)) {
            $this->photos->removeElement($photo);
            // set the owning side to null (unless already changed)
            if ($photo->getPicture() === $this) {
                $photo->setPicture(null);
            }
        }

        return $this;
    }

    public function getTranslation(string $locale)
    {
        return $this->pictureTranslations
            ->filter(function ($translation) use ($locale){
                /** @var PictureTranslation $translation */
                return $translation->getLocale() == $locale;
            })
            ->first();
    }

    public function getSliderPosition(): ?int
    {
        return $this->sliderPosition;
    }

    public function setSliderPosition(?int $sliderPosition): self
    {
        $this->sliderPosition = $sliderPosition;

        return $this;
    }
}
