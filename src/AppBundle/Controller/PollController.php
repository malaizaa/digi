<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Poll;

class PollController extends Controller
{
    /**
     * @Route("/", name="start_poll")
     */
    public function indexAction(Request $request)
    {
        $formData = new Poll();

        return $this->render('poll/index.html.twig', [
            'test' => 'test',
        ]);
    }
}
