<?php

namespace App\Service\PictureHandler;

use App\Collection\PictureCollection;
use App\Entity\Photo;
use App\Entity\Picture;
use App\Entity\PictureTranslation;
use App\Model\ContentModel;
use App\Model\PictureModel;
use App\Model\UpdatePictureModel;
use App\Repository\PictureRepository;
use App\Repository\PictureTranslationRepository;
use App\Service\FileManager\FileManager;
use App\Service\FileManager\FileManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PictureHandler implements PictureHandlerInterface, PictureTranslationHandlerInterface
{
    private const UPLOADS_IMAGES_DIR = 'pictures/';

    /**
     * @var PictureRepository
     */
    private $pictureRepo;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var FileManager
     */
    private $fileUploader;
    /**
     * @var PictureTranslationRepository
     */
    private $pictureTranslationRepository;

    /**
     * PictureHandler constructor.
     * @param EntityManagerInterface $em
     * @param PictureRepository $repository
     * @param FileManagerInterface $fileManager
     * @param PictureTranslationRepository $pictureTranslationRepository
     */
    public function __construct(EntityManagerInterface $em,
                                PictureRepository $repository, FileManagerInterface $fileManager, PictureTranslationRepository $pictureTranslationRepository)
    {
        $this->em = $em;
        $this->pictureRepo = $repository;
        $this->fileUploader = $fileManager;
        $this->pictureTranslationRepository = $pictureTranslationRepository;
    }

    /**
     * @inheritDoc
     * @return PictureCollection
     */
    public function getAllPictures(): PictureCollection
    {
        return new PictureCollection($this->pictureRepo->findAll());
    }

    /**
     * @inheritDoc
     * @return PictureCollection
     */
    public function getPicturesInSlider(): PictureCollection
    {
        return new PictureCollection($this->pictureRepo->findPicturesInSlider());
    }

    /**
     * @inheritDoc
     * @param PictureModel $pictureModel
     */
    public function createPicture(PictureModel $pictureModel): void
    {
        $picture = new Picture();
        $picture->setPhoto($this->fileUploader->uploadFile($pictureModel->getPhoto(),self::UPLOADS_IMAGES_DIR));
        $this->savePhotos($pictureModel->getPhotos(), $picture);
        $this->em->persist($picture);
        $this->createPictureTranslation($picture,$pictureModel);
    }

    public function updatePicture(UpdatePictureModel $model, Picture $picture, array $photos): void
    {
        $newTitlePhoto = $this->fileUploader->uploadFile($model->getPhoto(), self::UPLOADS_IMAGES_DIR);
        $picture->setPhoto($newTitlePhoto);
        $this->updatePhotos($photos, $picture->getPhotos()->toArray());

        $this->em->flush();
    }

    /**
     * @inheritDoc
     * @param Picture $picture
     * @param PictureModel $model
     */
    public function createPictureTranslation(Picture $picture, PictureModel $model): void
    {
        $pictureTrans = new PictureTranslation();
        $pictureTrans->setBody($model->getBody())
            ->setLocale($model->getLocale())
            ->setTitle($model->getTitle())
            ->setPicture($picture);

        $this->em->persist($pictureTrans);
        $this->em->flush();
    }

    public function getTranslationBy(?int $id): ?PictureTranslation
    {
        return $this->pictureTranslationRepository->find($id);
    }

    public function updateTranslation(PictureTranslation $pictureTranslation, ContentModel $model): void
    {
        $pictureTranslation->setTitle($model->getTitle())
            ->setBody($model->getBody());

        $this->em->flush();
    }

    public function deletePicture(Picture $picture): void
    {
        if ($picture) {
            $this->fileUploader->deleteFile(self::UPLOADS_IMAGES_DIR, $picture->getPhoto());
            $this->deleteAdditionalPhotos($picture, $picture->getPhotos()->toArray());
            $this->em->remove($picture);
            $this->em->flush();
        }
    }

    public function deleteTranslation(PictureTranslation $articleTranslation): void
    {
        $this->em->remove($articleTranslation);
        $this->em->flush();
    }

    /**
     * @inheritDoc
     * @param int $picture
     * @param int $position
     */
    public function addPictureOnSlide(int $picture, int $position): void
    {
        $picture = $this->pictureRepo->find($picture);
        if($picture instanceof Picture){
            $picture->setSliderPosition($position);
            $this->em->flush();
        }
    }

    private function savePhotos(array $photos, Picture $picture): void
    {
        if ($photos) {
            foreach ($photos as $key => $photo) {
                $additionPicture = new Photo();
                $uploadedAdditionPicture = $this->fileUploader->uploadFile($photo['photo'], self::UPLOADS_IMAGES_DIR);
                $additionPicture->setPhoto($uploadedAdditionPicture);
                $picture->addPhoto($additionPicture);
            }
        }
    }

    private function updatePhotos(array $photos, array $additionalPictures): void
    {
        if ($photos) {
            $counter = 0;
            foreach ($additionalPictures as $additionalPicture) {
                $uploadedAdditionPicture = $this->fileUploader->uploadFile($photos[$counter]['photo'], self::UPLOADS_IMAGES_DIR);
                $additionalPicture->setPhoto($uploadedAdditionPicture);
                $counter++;
            }
        }
    }

    private function deleteAdditionalPhotos(Picture $picture, array $additionalPhotos): void
    {
        if ($additionalPhotos) {
            /** @var Photo $photo */
            foreach ($additionalPhotos as $photo) {
                $this->fileUploader->deleteFile(self::UPLOADS_IMAGES_DIR, $photo->getPhoto());
            }
        }
    }
}