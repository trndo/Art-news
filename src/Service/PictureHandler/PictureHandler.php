<?php

namespace App\Service\PictureHandler;

use App\Collection\PictureCollection;
use App\Entity\Picture;
use App\Entity\PictureTranslation;
use App\Model\PictureModel;
use App\Repository\PictureRepository;
use App\Service\FileManager\FileManager;
use Doctrine\ORM\EntityManagerInterface;

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
     * PictureHandler constructor.
     * @param EntityManagerInterface $em
     * @param PictureRepository $repository
     * @param FileManager $fileManager
     */
    public function __construct(EntityManagerInterface $em,
                                PictureRepository $repository, FileManager $fileManager)
    {
        $this->em = $em;
        $this->pictureRepo = $repository;
        $this->fileUploader = $fileManager;
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
     * @param PictureModel $pictureModel
     */
    public function createPicture(PictureModel $pictureModel): void
    {
        $picture = new Picture();
        $picture->setPhoto($this->fileUploader->uploadFile($pictureModel->getPhoto(),self::UPLOADS_IMAGES_DIR));
        $this->em->persist($picture);
        $this->createPictureTranslation($picture,$pictureModel);
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
}