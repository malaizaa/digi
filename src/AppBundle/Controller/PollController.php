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

        $flow = $this->get('app.form.flow.poll');
        $flow->bind($formData);

        // form of the current step
        $form = $flow->createForm();
        if ($flow->isValid($form)) {
            $flow->saveCurrentStepData($form);

            // upload image
            if ($file = $formData->getImage()) {
                $fileName = $this->get('app.service.image_uploader')->upload($file);
                $formData->setImage($fileName);
            }

            $this->savePoll($formData);

            if ($flow->nextStep()) {
                // form for the next step
                $form = $flow->createForm();
            } else {
                // flow finished
                $flow->reset(); // remove step data from the session

                return $this->redirectToRoute('start_poll'); // redirect when done
            }
        }

        return $this->render('poll/index.html.twig', [
            'form' => $form->createView(),
            'flow' => $flow,
        ]);
    }

    /**
     * @param Poll $poll
     *
     * @return Poll
     */
    protected function savePoll(Poll $poll) : Poll
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($poll);
        $em->flush();

        return $poll;
    }
}
