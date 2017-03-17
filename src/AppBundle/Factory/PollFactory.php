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
        $poll = $this->getPollFromRequest($request);

        if ($poll instanceof Poll) {
            return $poll;
        }

        return new Poll();
    }

    /**
     * @param Request $request
     *
     * @return Poll|null
     */
    public function getPollFromRequest(Request $request)
    {
        if ($request->cookies->has('poll_id')) {
            $pollId = $request->cookies->get('poll_id');

            return $this->objectManager->getRepository('AppBundle:Poll')->find($pollId);
        }

        return null;
    }
}
