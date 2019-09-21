<?php


namespace App\Model;


use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UpdatePictureModel
{
    /**
     * @var string|UploadedFile|null
     */
    private $photo;

    /**
     * @var array|null
     */
    private $photos;

    /**
     * @return string|UploadedFile|null
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string|UploadedFile|null $photo
     * @return UpdatePictureModel
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * @param array|null $photos
     * @return UpdatePictureModel
     */
    public function setPhotos(?array $photos): UpdatePictureModel
    {
        $this->photos = $photos;

        return $this;
    }
}