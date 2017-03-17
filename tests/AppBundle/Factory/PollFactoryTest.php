<?php

namespace Tests\AppBundle\Factory;

use AppBundle\Service\FileUploader;
use AppBundle\Factory\PollFactory;
use AppBundle\Entity\Poll;

class PollFactoryTest extends \PHPUnit_Framework_TestCase
{
    protected $objectManager;
    protected $sut;
    protected $request;
    protected $repository;

    public function __construct()
    {
        $this->objectManager = $this->createMock('Doctrine\Common\Persistence\ObjectManager');
        $this->repository = $this->createMock('\Doctrine\Common\Persistence\ObjectRepository');

        $this->objectManager
           ->expects($this->any())
           ->method('getRepository')
           ->with('AppBundle:Poll')
           ->willReturn($this->repository);

        $this->sut = new PollFactory($this->objectManager);
        $this->request = $this->createMock('Symfony\Component\HttpFoundation\Request');
        $this->request->cookies = $this->createMock('Symfony\Component\HttpFoundation\ParameterBag');
    }

    public function testItIniciatesEmptyObjectWhenNoCookieInRequest()
    {
        $this->request->cookies
            ->expects($this->atLeastOnce())
            ->method('has')
            ->with('poll_id')
            ->willReturn(null);

        $result = $this->sut->createPoll($this->request);
        $this->assertEquals(null, $result->getId());
    }

    public function testItIniciatesEmptyObjectWhenNoPollFoundInRepository()
    {
        $this->request->cookies
            ->expects($this->atLeastOnce())
            ->method('has')
            ->with('poll_id')
            ->willReturn(true);

        $this->request->cookies
            ->expects($this->atLeastOnce())
            ->method('get')
            ->with('poll_id')
            ->willReturn(1);

        $this->repository
            ->expects($this->atLeastOnce())
            ->method('find')
            ->with(1)
            ->willReturn(null);

        $result = $this->sut->createPoll($this->request);
        $this->assertEquals(null, $result->getId());
    }

    public function testItReturnsObjectFromRepository()
    {
        $object = new Poll();
        $object->setQuestion(1);

        $this->request->cookies
            ->expects($this->atLeastOnce())
            ->method('has')
            ->with('poll_id')
            ->willReturn(true);

        $this->request->cookies
            ->expects($this->atLeastOnce())
            ->method('get')
            ->with('poll_id')
            ->willReturn(2);

        $this->repository
            ->expects($this->atLeastOnce())
            ->method('find')
            ->with(2)
            ->willReturn($object);

        $result = $this->sut->createPoll($this->request);
        $this->assertEquals(1, $result->getQuestion());
    }
}
