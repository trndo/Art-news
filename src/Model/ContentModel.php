<?php


namespace App\Model;


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
     * @var string|null
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
    public function setTitle(?string $title): ContentModel
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
    public function setBody(?string $body): ContentModel
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
    public function setLocale(?string $locale): ContentModel
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    /**
     * @param string|null $photo
     * @return ContentModel
     */
    public function setPhoto(?string $photo): ContentModel
    {
        $this->photo = $photo;
        return $this;
    }


}