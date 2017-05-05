<?php

namespace FarmBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class ProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', null, ["label" => "Nom"])
                ->add('price', MoneyType::class, ["label" => "Prix HT", "invalid_message" => "cette valeur n'est pas valide !"])
                ->add('description', null, ["label" => "Description"])
                ->add('quantity', null, ["label" => "Quantité",
                                         "attr" => ["class" => "pouf"]
                                        ])
                ->add('isActive', ChoiceType::class, ["expanded" => true,
                                                      "multiple" => false,
                                                      "choices_as_values" => true,
                                                      "choices" => [
                                                          "actif" => true,
                                                          "Inactif" => false
                                                          ]
                                                      ])
                ->add('category', null, ["label" => "Categories"])
                ->add('submit', SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FarmBundle\Entity\Product'
        ));
    }


    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'farmbundle_product';
    }


}
