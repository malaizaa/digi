<?php

// src/AppBundle/Factory/PollFacotry.php
namespace AppBundle\Factory;

use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Poll;
use Symfony\Component\HttpFoundation\Request;

class PollFactory
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @param Request $request
     *
     * @return Poll
     */
    public function createPoll(Request $request) : Poll
    {
        if ($request->cookies->has('poll_id')) {
            $pollId = $request->cookies->get('poll_id');
            $poll = $this->objectManager->getRepository('AppBundle:Poll')->find($pollId);

            if ($poll instanceof Poll) {
                return $poll;
            }
        }

        return new Poll();
    }
}
