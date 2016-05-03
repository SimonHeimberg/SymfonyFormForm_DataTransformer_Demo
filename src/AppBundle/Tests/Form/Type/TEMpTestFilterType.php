<?php

namespace AppBundle\Tests\Form\Types;

use Symfony\Component\Form\Test\FormIntegrationTestCase;
use AppBundle\Form\Type\TEMpTestTransformersType;

class TEMpFilterTypeTest extends FormIntegrationTestCase #TypeTestCase
{
    public function testSubmitValidData()
    {
        //
        $type = new TEMpTestTransformersType();
        $form = $this->factory->create($type);

        $data = 'k3j';
        $form->submit($data);

        $this->assertTrue($form->isSynchronized(), 'synchronized');
        $this->assertEquals(
            array(
                'd' => "${data}VM",
                'n' => "${data}V",
                'v' => "${data}Vv",
            ),
            array(
                'd' => $form->getData(),
                'n' => $form->getNormData(),
                'v' => $form->getViewData(),
            )
        );
    }

    public function testSetData()
    {
        $data = 'hek';

        $type = new TEMpTestTransformersType();
        $form = $this->factory->create($type, $data);

        $this->assertTrue($form->isSynchronized(), 'synchronized');
        $this->assertEquals(
            array(
                'd' => "${data}",
                'n' => "${data}m",
                'v' => "${data}mv",
            ),
            array(
                'd' => $form->getData(),
                'n' => $form->getNormData(),
                'v' => $form->getViewData(),
            )
        );
    }


    public function testSubmitInForm()
    {
        $form = $this->factory->createBuilder()
            ->add('txt', TEMpTestTransformersType::class)
            ->getForm();

        $dataVal = 'zwej';
        $data = array('txt' => $dataVal);
        $form->submit($data);

        $this->assertTrue($form->isSynchronized(), 'synchronized');
        $this->assertEquals(
            // I expect the same as for the component, but this will fail
            array(
                'd' => array('txt' => "${dataVal}VM"),
                'n' => array('txt' => "${dataVal}V"),
                'v' => array('txt' => "${dataVal}Vv"),
            ),
            array(
                'd' => $form->getData(),
                'n' => $form->getNormData(),
                'v' => $form->getViewData(),
            )
        );
    }

    public function testDataInForm()
    {
        $dataVal = 'eolw';
        $data = array('tsd' => $dataVal);

        $form = $this->factory->createBuilder('Symfony\Component\Form\Extension\Core\Type\FormType', $data)
            ->add('tsd', TEMpTestTransformersType::class)
            ->getForm();

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals(
            // I expect the same as for the component, but this will fail
            array(
                'd' => array('tsd' => "${dataVal}"),
                'n' => array('tsd' => "${dataVal}m"),
                'v' => array('tsd' => "${dataVal}mv"),
            ),
            array(
                'd' => $form->getData(),
                'n' => $form->getNormData(),
                'v' => $form->getViewData(),
            )
        );
    }
}
