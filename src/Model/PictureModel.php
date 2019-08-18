<?php


namespace App\Model;


class PictureModel
{
    /**
     * @var string|null
     */
    private $photo;

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
     * @var array|null
     */
    private $photos;

    /**
     * @return string|null
     */
    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    /**
     * @param string|null $photo
     * @return PictureModel
     */
    public function setPhoto(?string $photo): PictureModel
    {
        $this->photo = $photo;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return PictureModel
     */
    public function setTitle(?string $title): PictureModel
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
     * @return PictureModel
     */
    public function setBody(?string $body): PictureModel
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
     * @return PictureModel
     */
    public function setLocale(?string $locale): PictureModel
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getPhotos(): ?array
    {
        return $this->photos;
    }

    /**
     * @param array|null $photos
     * @return PictureModel
     */
    public function setPhotos(?array $photos): PictureModel
    {
        $this->photos = $photos;
        return $this;
    }


}