<?php

namespace AppBundle\Form;

use Craue\FormFlowBundle\Form\FormFlow;

class PollFlow extends FormFlow
{
    /**
     * @return array
     */
    public function loadStepsConfig() : array
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
                'label' => 'Kokias programavimo kalbas mokate?',
                'form_type' => 'AppBundle\Form\PollForm',
                'form_options' => [
                    'validation_groups' => ['step5'],
                ],
            ],
            [
                'label' => 'Prašome patalpinti savo nuotrauka?',
                'form_type' => 'AppBundle\Form\PollForm',
                'form_options' => [
                    'validation_groups' => ['step6'],
                ],
            ],
        ];
    }
}
