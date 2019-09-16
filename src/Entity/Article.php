<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
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
     * @ORM\OneToMany(targetEntity="App\Entity\ArticleTranslation", mappedBy="article", cascade={"persist","remove"})
     */
    private $articleTranslations;


    public function __construct()
    {
        $this->articleTranslations = new ArrayCollection();
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
     * @return Collection|ArticleTranslation[]
     */
    public function getArticleTranslations(): Collection
    {
        return $this->articleTranslations;
    }

    public function addArticleTranslation(ArticleTranslation $articleTranslation): self
    {
        if (!$this->articleTranslations->contains($articleTranslation)) {
            $this->articleTranslations[] = $articleTranslation;
            $articleTranslation->setArticle($this);
        }

        return $this;
    }

    public function removeArticleTranslation(ArticleTranslation $articleTranslation): self
    {
        if ($this->articleTranslations->contains($articleTranslation)) {
            $this->articleTranslations->removeElement($articleTranslation);
            // set the owning side to null (unless already changed)
            if ($articleTranslation->getArticle() === $this) {
                $articleTranslation->setArticle(null);
            }
        }

        return $this;
    }

    public function getTranslation(string $locale)
    {
        return $this->articleTranslations
            ->filter(function ($translation) use ($locale){
                /** @var ArticleTranslation $translation */
                return $translation->getLocale() == $locale;
            })
            ->first();
    }
}
