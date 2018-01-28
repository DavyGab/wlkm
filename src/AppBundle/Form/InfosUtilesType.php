<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InfosUtilesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('texte', TextareaType::class)
            ->add('status')
            ->add('type')
            ->add('borne')
            ->add('titre')
            ->add('status', EntityType::class, array(
                'class' => 'AppBundle:Status',
                'query_builder' => function($er) {
//                    return $statusRepository->findByEntite('Annuaire');
                    return $er->createQueryBuilder('s')->where('s.entite = ?1')->setParameter(1, 'InfoUtile');
                },
                'required'  => true,
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\InfosUtiles'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_infosutiles';
    }


}
