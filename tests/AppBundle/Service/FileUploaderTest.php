<?php

namespace Tests\AppBundle\Service;

use AppBundle\Service\FileUploader;

class FileUploaderTest extends \PHPUnit_Framework_TestCase
{
    public function testItReturnsCorrectTargetDir()
    {
        $uploader = new FileUploader('any_dir');
        $this->assertEquals('any_dir', $uploader->getTargetDir());
    }

    public function testItUploadsAndMovesFileToTargetDir()
    {
        $file = $this->createMock(\Symfony\Component\HttpFoundation\File\UploadedFile::class);

        $file->method('getFilename')
            ->willReturn('my_filename');
        $file->method('guessExtension')
            ->willReturn('jpeg');

        $file->method('move')->with(
            'any_dir', 'aa3396ae236b731574d533f66bb61cf1.jpeg'
        );

        $uploader = new FileUploader('any_dir');
        $this->assertEquals('aa3396ae236b731574d533f66bb61cf1.jpeg', $uploader->upload($file));
    }
}
