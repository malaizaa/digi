<?php

namespace Tests\AppBundle\Form;

use AppBundle\Form\PollFlow;

class PoolFlowTest extends \PHPUnit_Framework_TestCase
{
    public function testItsExtendsFormFlow()
    {
        $this->assertInstanceof('\Craue\FormFlowBundle\Form\FormFlow', new PollFlow());
    }

    public function testItLoadsStepsConfig()
    {
        $config = [
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
                'label' => 'Kokias programavimo kalbas mokate?',
                'form_type' => 'AppBundle\Form\PollForm',
                'form_options' => [
                    'validation_groups' => ['step6'],
                ],
            ],
        ];

        $flow = new PollFlow();
        $this->assertEquals($config, $flow->loadStepsConfig());
    }
}
