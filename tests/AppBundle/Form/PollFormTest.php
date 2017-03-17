<?php

namespace Tests\AppBundle\Form;

use AppBundle\Form\PollForm;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PoolFormTest extends \PHPUnit_Framework_TestCase
{
    public function testItsExtendsAbstractFormType()
    {
        $this->assertInstanceof('\Symfony\Component\Form\AbstractType', new PollForm());
    }

    /**
     * @dataProvider formProvider
     */
    public function testItBuildsForm($step, $fieldName, $fieldType, $options)
    {
        $form = new PollForm();
        $builder = $this->createMock(\Symfony\Component\Form\FormBuilderInterface::class);

        $builder->method('add')
            ->with($fieldName, $fieldType, $options)
            ->willReturn($builder);

        $form->buildForm($builder, ['flow_step' => $step]);
    }

    public function testItReturnsBlockPrefix()
    {
        $form = new PollForm();
        $this->assertEquals('poll', $form->getBlockPrefix());
    }

    function formProvider()
    {
        return [
            [1, 'name', TextType::class, [
                    'label' => 'Koks jūsų vardas',
                    'required' => false,
                ]
            ],
            [2, 'birthDate', BirthdayType::class, [
                    'label' => 'Jūsų gimimo data',
                    'required' => false,
                ]
            ],
            [3, 'gender', ChoiceType::class, [
                    'label' => 'Lytis',
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => [
                        'vyras' => 'm',
                        'moteris' => 'f',
                    ],
                ]
            ],
            [4, 'isInterestedProgramming', ChoiceType::class, [
                    'label' => 'Ar domitės programavimu?',
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => [
                        'taip' => 1,
                        'ne' => 0
                    ],
                ]
            ],
        ];
    }
}
