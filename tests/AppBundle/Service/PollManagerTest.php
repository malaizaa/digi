<?php

namespace Tests\AppBundle\Service;

use AppBundle\Service\FileUploader;
use AppBundle\Service\PollManager;
use AppBundle\Entity\Poll;

class PollManagerTest extends \PHPUnit_Framework_TestCase
{
    protected $objectManager;
    protected $sut;
    protected $flow;
    protected $uploader;

    public function __construct()
    {
        $this->objectManager = $this->createMock('Doctrine\Common\Persistence\ObjectManager');
        $this->uploader = $this->createMock('AppBundle\Service\FileUploader');
        $this->flow = $this->createMock('AppBundle\Form\PollFlow');
        $this->sut = new PollManager($this->uploader, $this->objectManager);

        // always expect persit and flush
        $this->objectManager
            ->expects($this->once())
            ->method('persist');

        $this->objectManager
            ->expects($this->once())
            ->method('flush');
    }

    public function testItNotUploadsFileUntilStep6()
    {
        $this->flow
            ->expects($this->atLeastOnce())
            ->method('getCurrentStep')
            ->willReturn(5);

        $this->uploader
            ->expects($this->never())
            ->method('upload');

        $poll = new Poll();
        $this->sut->processPollDataByFlow($this->flow, $poll);
        $this->assertEquals(5, $poll->getQuestion());

        $this->assertNull($poll->getImage());
    }

    public function testItUploadsFileOnStep6WhenFileIsAtached()
    {
        $fileMock = $this->createMock('Symfony\Component\HttpFoundation\File\UploadedFile');
        $this->flow
            ->expects($this->atLeastOnce())
            ->method('getCurrentStep')
            ->willReturn(6);

        $this->uploader
            ->expects($this->atLeastOnce())
            ->method('upload')
            ->with($fileMock)
            ->willReturn('any_file_name');

        $poll = new Poll();
        $poll->setImage($fileMock);
        $this->sut->processPollDataByFlow($this->flow, $poll);
        $this->assertEquals(6, $poll->getQuestion());
        $this->assertEquals('any_file_name', $poll->getImage());
    }
}
