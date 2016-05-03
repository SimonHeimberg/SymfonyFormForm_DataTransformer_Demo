<?php

/** entering x in the field in the form and submitting:
              result expected  problem?
- displaying  xVv    xVv
- getData     xVM    xVM
- getNormData xVM    xV        X
- getViewData xVM    xVv       X
*/

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TEMpTestTransformersType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new TestTransformer('m');
        $builder->addModelTransformer($transformer);
        $transformer = new TestTransformer('v');
        $builder->addViewTransformer($transformer);
    }

    public function getParent()
    {
        return TextType::class;
    }
}

class TestTransformer implements DataTransformerInterface
{
    public function __construct($appendChr)
    {
        $this->t = strtolower($appendChr);
        $this->r = strtoupper($appendChr);
    }
    
    public function transform($original)
    {
        if (null === $original) return 'n';
        return $original.$this->t;
    }

    public function reverseTransform($submitted)
    {
        return $submitted.$this->r;
    }
}
