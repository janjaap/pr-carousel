<?php
namespace PR\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ExpertiseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('discipline', 'choice', array());
    }

    public function getName()
    {
        return 'expertise';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'PR\Entity\Expertise'
        );
    }
}
