<?php

// src/AppBundle/Service/FileUploader.php
namespace AppBundle\Service;

use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Service\FileUploader;
use AppBundle\Form\PollFlow;
use AppBundle\Entity\Poll;

class PollManager
{
    /**
     * @var FileUploader
     */
    protected $uploader;

    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @param FileUploader  $uploader
     * @param ObjectManager $objectManager
     */
    public function __construct(FileUploader $uploader, ObjectManager $objectManager)
    {
        $this->uploader = $uploader;
        $this->objectManager = $objectManager;
    }

    /**
     * @param PollFlow $flow
     * @param Poll $poll
     *
     * @return Poll
     */
    public function processPollDataByFlow(PollFlow $flow, Poll $poll)
    {
        // always save current question
        $poll->setQuestion($flow->getCurrentStep());

        // upload image if step 6 reached and file attached
        if (($file = $poll->getImage()) && 6 === $flow->getCurrentStep()) {
            $fileName = $this->uploader->upload($file);
            $poll->setImage($fileName);
        }

        // always update poll data from form
        $this->objectManager->persist($poll);
        $this->objectManager->flush();

        return $poll;
    }
}
