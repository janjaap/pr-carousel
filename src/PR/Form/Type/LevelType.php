<?php
namespace PR\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class LevelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('indication', 'text', array());
    }

    public function getName()
    {
        return 'level';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'PR\Entity\Level'
        );
    }
}
