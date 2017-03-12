<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

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
                    'choices' => [
                        'm' => 'vyras',
                        'f' => 'moteris'
                    ],
                ]);
                break;
            case 4:
                $builder->add('isInterestedProgramming', ChoiceType::class, [
                    'label' => 'Ar domitės programavimu?',
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => [
                        'taip' => 1,
                        'ne' => 0
                    ],
                ]);
                break;
            case 5:
                $builder->add('skills', ChoiceType::class, [
                    'label' => 'Kokias programavimo kalbas mokate?',
                    'expanded' => true,
                    'multiple' => true,
                    'choices' => [
                        'PHP' => 'test',
                    	'CSS' => 1,
                    	'HTML' => 2,
                    	'JavaScript' => 3,
                    	'Java' => 4,
                    	'Nemoku nė vienos' => 'none'
                    ],
                ]);
                break;
            case 6:
                $builder->add('image', FileType::class, [
                    'label' => 'Prašome patalpinti savo nuotrauka',
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
