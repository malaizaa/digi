<?php

namespace AppBundle\Form;

use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Form\FormFlowInterface;

class PollFlow extends FormFlow
{
    /**
     * @return array
     */
    protected function loadStepsConfig() : array
    {
        return [
            [
                'label' => 'Koks jūsų vardas',
                'form_type' => 'AppBundle\Form\PollForm',
                'form_options' => [
                    'validation_groups' => ['step1'],
                ],
            ],
            [
                'label' => 'Jūsų gimimo data',
                'form_type' => 'AppBundle\Form\PollForm',
                'form_options' => [
                    'validation_groups' => ['step2'],
                ],
            ],
            [
                'label' => 'Lytis',
                'form_type' => 'AppBundle\Form\PollForm',
                'form_options' => [
                    'validation_groups' => ['step3'],
                ],
            ],
            [
                'label' => 'Ar domitės programavimu?',
                'form_type' => 'AppBundle\Form\PollForm',
                'form_options' => [
                    'validation_groups' => ['step4'],
                ],
            ],
            [
                'label' => 'confirmation',
            ],
        ];
    }
}
