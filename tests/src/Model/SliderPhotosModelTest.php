<?php

namespace App\Tests\src\Model;

use App\Collection\PictureCollection;
use App\Entity\Picture;
use App\Model\Slide;
use App\Model\SliderPhotosModel;
use PHPUnit\Framework\TestCase;

class SliderPhotosModelTest extends TestCase
{

    /**
     * @dataProvider provideProductCollectionForCountingSlides
     * @param PictureCollection $pictures
     * @param int $expectedSlides
     */
    public function testSlidesCount(PictureCollection $pictures, int $expectedSlides)
    {
        $slidePhotosModel = new SliderPhotosModel($pictures);
        $this->assertEquals($expectedSlides,$slidePhotosModel->countSlides());
    }

    /**
     * @dataProvider provideProductCollectionForCountingSlides
     * @param PictureCollection $pictures
     * @param int $expectedSlides
     */
    public function testSlides(PictureCollection $pictures, int $expectedSlides)
    {
        $slidePhotosModel = new SliderPhotosModel($pictures);
        $this->assertCount($expectedSlides,$slidePhotosModel->getSlides());
    }

    /**
     * @dataProvider provideProductCollection
     * @param PictureCollection $pictures
     * @param int $expectedSlide
     */
    public function testSliderValid(PictureCollection $pictures, int $expectedSlide)
    {
        $slidePhotosModel = new SliderPhotosModel($pictures);
        $this->assertInstanceOf(Slide::class,$slidePhotosModel->getSlides()[$expectedSlide]);
    }


    public function testCountPhotoInSlides()
    {
        $pictures = new PictureCollection([new Picture(), new Picture()]);
        $slidePhotosModel = new SliderPhotosModel($pictures);
        $this->assertCount(2,$slidePhotosModel->getSlides()[0]->getPictures());
    }

    public function provideProductCollectionForCountingSlides()
    {
        $arr1 = []; $arr2 = []; $arr3 = [];

        for ($i = 1; $i <= 15; $i++)
            $arr1[] = new Picture();

        for ($i = 1; $i <= 20; $i++)
            $arr2[] = new Picture();

        for ($i = 1; $i <= 8; $i++)
            $arr3[] = new Picture();

        return [
            /*[new PictureCollection($arr1), 2],
            [new PictureCollection($arr2), 3],
            [new PictureCollection([new Picture(), new Picture()]), 1],*/
            [new PictureCollection($arr3), 1]
        ];
    }

    public function provideProductCollection()
    {
        $arr1 = []; $arr2 = []; $arr3 = [];

        for ($i = 1; $i <= 15; $i++)
            $arr1[] = new Picture();

        for ($i = 1; $i <= 20; $i++)
            $arr2[] = new Picture();

        for ($i = 1; $i <= 8; $i++)
            $arr3[] = new Picture();

        return [
            [new PictureCollection($arr1), 1],
            [new PictureCollection($arr2), 2],
            [new PictureCollection([new Picture(), new Picture()]), 0],
            [new PictureCollection($arr3), 0]
        ];
    }
}