<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PollForm extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        switch ($options['flow_step']) {
            case 1:
                $builder->add('name', TextType::class, [
                    'label' => 'Koks jūsų vardas',
                    'required' => false,
                ]);
                break;
            case 2:
                $builder->add('birthDate', BirthdayType::class, [
                    'label' => 'Jūsų gimimo data',
                    'required' => false,
                ]);
                break;
            case 3:
                $builder->add('gender', ChoiceType::class, [
                    'label' => 'Lytis',
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array(
                        'm' => 'vyras',
                        'f' => 'moteris'
                    ),
                ]);
            case 4:
                $builder->add('isInterestedProgramming', ChoiceType::class, [
                    'label' => 'Lytis',
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array(
                        'y' => 'taip',
                        'n' => 'ne'
                    ),
                ]);
                break;
        }
    }

    /**
     * @return string
     */
    public function getBlockPrefix() : string
    {
        return 'poll';
    }
}
