<?php


namespace App\Model;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class ContentModel
{
    /**
     * @var string|null
     */
    private $title;

    /**
     * @var string|null
     */
    private $body;

    /**
     * @var string|null
     */
    private $locale;

    /**
     * @var UploadedFile|null
     */
    private $photo;

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return ContentModel
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBody(): ?string
    {
        return $this->body;
    }

    /**
     * @param string|null $body
     * @return ContentModel
     */
    public function setBody(?string $body): self
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return $this->locale;
    }

    /**
     * @param string|null $locale
     * @return ContentModel
     */
    public function setLocale(?string $locale): self
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * @return UploadedFile|null
     */
    public function getPhoto(): ?self
    {
        return $this->photo;
    }

    /**
     * @param UploadedFile|null $photo
     * @return ContentModel
     */
    public function setPhoto(?UploadedFile $photo): self
    {
        $this->photo = $photo;
        return $this;
    }


}