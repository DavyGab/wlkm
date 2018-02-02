<?php

namespace AppBundle\Form;

use AppBundle\Entity\ImagesAnnuaire;
use AppBundle\Repository\StatusRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnuaireType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('adresse')
//            ->add('horaires')
            ->add('description', TextareaType::class)
            ->add('ville')
            ->add('codePostal')
            ->add('categorie', null, array('required' => true))
            ->add('annuaireBorne', CollectionType::class, array(
                'entry_type' => AnnuaireBorneType::class,
                'entry_options' => array('label' => false),
                'allow_add' => true,
                'allow_delete' => true,
            ))
            ->add('status', EntityType::class, array(
                'class' => 'AppBundle:Status',
                'query_builder' => function($er) {
//                    return $statusRepository->findByEntite('Annuaire');
                    return $er->createQueryBuilder('s')->where('s.entite = ?1')->setParameter(1, 'Annuaire');
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
            'data_class' => 'AppBundle\Entity\Annuaire'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_annuaire';
    }


}
