<?php

namespace AppBundle\Form;

use AppBundle\Entity\ImagesAnnuaire;
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
            ->add('categorie')
            ->add('annuaireBorne', CollectionType::class, array(
                'entry_type' => AnnuaireBorneType::class,
                'entry_options' => array('label' => false),
                'allow_add' => true,
                'allow_delete' => true,
            ))
            ->add('annuaireImage', CollectionType::class, array(
                'entry_type' => ImagesAnnuaireType::class,
                'entry_options' => array('label' => false),
                'allow_add' => true,
                'allow_delete' => true,
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
