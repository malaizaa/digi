<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Cookie;
use AppBundle\Entity\Poll;

class PollController extends Controller
{
    /**
     * @Route("/", name="poll_start")
     */
    public function indexAction(Request $request)
    {
        $flow = $this->get('app.form.flow.poll');
        $poll = $this->get('app.factory.poll_factory')->createPoll($request);
        $flow->bind($poll);
        $form = $flow->createForm();

        if ($flow->isValid($form)) {
            $flow->saveCurrentStepData($form);

            $this->get('app.service.poll_manager')->processPollDataByFlow($flow, $poll);

            if ($flow->nextStep()) {
                $form = $flow->createForm();
            } else {
                $flow->reset();

                return $this->redirectToRoute('poll_finished');
            }
        }

        return $this->returnResponse($poll, ['form' => $form->createView(), 'flow' => $flow]);
    }

    /**
     * @Route("/finished", name="poll_finished")
     */
    public function finishedAction()
    {
        return $this->render('poll/finished.html.twig');
    }

    /**
     * @param Poll  $poll
     * @param array $params
     *
     * @return Response|RedirectResponse
     */
    protected function returnResponse(Poll $poll, array $params)
    {
        // if poll was finished in step 4 when redirect user other view
        if ($poll->isFinishedInStep4()) {
            return $this->redirectToRoute('poll_finished');
        }

        $response = $this->render('poll/index.html.twig', $params);

        $response->headers->setCookie(new Cookie('poll_id', $poll->getId()));

        return $response;
    }
}
