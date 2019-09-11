<?php


namespace App\Tests\src\Service\FileManager;


use App\Service\FileManager\FileManager;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileManagerTest extends TestCase
{
    protected $stub;
    protected $dir;

    public function setUp()
    {
       $this->stub = $this->createMock(LoggerInterface::class);
       $this->dir = __DIR__.'/../../../public/uploads/';
    }

    /**
     * @dataProvider getUploadedFiles
     * @param $file
     */
    public function testUploadingFile($file)
    {
        $fileManager = new FileManager($this->dir, $this->stub);
        $res = $fileManager->uploadFile($file,'images');
        $this->assertInternalType('string',$res);
    }

    public function getUploadedFiles()
    {
        return [
            [new UploadedFile('C:\Users\ВИТАЛИЙ\PhpstormProjects\Art-news\public\testImages\test1.png','test1.png','image/png',UPLOAD_ERR_OK,true )],
            [new UploadedFile('C:\Users\ВИТАЛИЙ\PhpstormProjects\Art-news\public\testImages\test2.jpg','test2.jpg','image/jpeg',UPLOAD_ERR_OK,true )],
        ];
    }
}