<?php

namespace App\Tests\src\Model;

use App\Entity\Picture;
use App\Model\Slide;
use PHPUnit\Framework\TestCase;

class SlideTest extends TestCase
{
    /**
     * @dataProvider providePictures
     * @param array $photos
     */
    public function testReturnPhotoByIndex(array $photos)
    {
        $slide = new Slide($photos);
        $this->assertInstanceOf(Picture::class,$slide->get(1));
        $this->assertSame('123',$slide->get(1)->getPhoto());
        $this->assertNull($slide->get(5));
    }

    public function providePictures()
    {
        return [
          [
              [(new Picture())->setPhoto('222'), (new Picture())->setPhoto('123')]
          ],
        ];
    }
}