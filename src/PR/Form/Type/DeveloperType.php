<?php
namespace PR\Form\Type;

use PR\Entity\Loader\Expertise as ExpertiseEntityLoader;
use PR\Entity\Developer;

use Symfony\Bridge\Doctrine\Form\ChoiceList\EntityChoiceList;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\DataTransformer\ChoicesToValuesTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;

class DeveloperType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var Developer $developer */
        $entityManager = $options['entityManager'];
//        $levelToIndicationTransformer     = new LevelToIndicationTransformer($entityManager);
//        $expertiseToDisciplineTransformer = new LevelToIndicationTransformer($entityManager);

        $builder->add('id', 'hidden');

        $builder->add('name', 'text', [
            'constraints' => [
                new Assert\NotBlank()
            ]
        ]);

        $builder->add('handle', 'text', [
            'constraints' => [
                new Assert\NotBlank()
            ]
        ]);

        $expertiseEntityLoader = (new ExpertiseEntityLoader())->setRepository($entityManager->getRepository('PR\Entity\Expertise'));
        $eclExpertise          = new EntityChoiceList($entityManager, 'PR\Entity\Expertise', null,
            $expertiseEntityLoader);

        $builder->add(
            $builder->create('expertise', 'collection', [
                'type'         => new ExpertiseType(),
                'options'      => [
                    'required'   => false,
                    'data_class' => 'PR\Entity\Expertise'
                ],
                'allow_add'    => true,
                'allow_delete' => true
            ])->addViewTransformer(new ChoicesToValuesTransformer($eclExpertise))
        );

//        $builder->add('level', 'collection', [
//            'type'         => new LevelType(),
//            'options'      => [
//                'required'   => false,
//                'data_class' => 'PR\Entity\Level'
//            ],
//            'allow_add'    => true,
//            'allow_delete' => true
//        ]);

        $builder->add('save', 'submit');
    }

    /**
     * {@inheritdoc}
     *
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class'    => 'PR\Entity\Developer',
            'entityManager' => null
        ])->setRequired([
            'entityManager',
        ])->setAllowedTypes([
            'entityManager' => 'Doctrine\ORM\EntityManager',
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pr_form_type_developer';
    }
}
