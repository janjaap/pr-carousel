<?php
use Doctrine\ORM\EntityNotFoundException;
use PR\Form\Type\DeveloperType;
use Silex\Application;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig', [

    ]);
});

$app->get('/profile/{handle}', function (Application $app, Request $request, $handle = null) use ($entityManager) {
    $responseParams      = [];
    $developerRepository = $entityManager->getRepository('PR\Entity\Developer');

    /** @var PR\Entity\Developer $developer */
    if (null === ($developer = $developerRepository->findOneBy(['handle' => $handle]))) {
        throw new EntityNotFoundException();
    }

    $responseParams['developer'] = $developer;

    $formData = [
        'id'        => $developer->getId(),
        'name'      => $developer->getName(),
        'handle'    => $developer->getHandle(),
        'level'     => $developer->getLevel()->getIndication(),
        'expertise' => $developer->getExpertise()
    ];

    /** @var FormFactory $formFactory */
    $formFactory = $app['form.factory'];
    $form = $formFactory->create(new DeveloperType(), $developer, ['entityManager' => $entityManager]);
//
//    /** @var Symfony\Component\Form\Form $form */
//    $form = $app['form.factory']
//        ->createBuilder('form', $formData)
//        ->add('id', 'hidden')
//        ->add('name', 'text', [
//            'constraints' => [
//                new Assert\NotBlank()
//            ]
//        ])
//        ->add('handle', 'text', [
//            'constraints' => [
//                new Assert\NotBlank()
//            ]
//        ])
//        ->add('level')
//        ->add('gender', 'choice', [
//            'choices'  => [1 => 'male', 2 => 'female'],
//            'expanded' => true,
//        ])
//        ->getForm();

    switch ($request->getMethod()) {
        case 'POST':
            $form->handleRequest($request);

            if ($form->isValid()) {
                $formData = $form->getData();

                var_dump($formData);
                die;
                // do something with the data

                // redirect somewhere
                return $app->redirect('...');
            }

            break;
    }

    $responseParams['form'] = $form->createView();

    return $app['twig']->render('profile.html.twig', $responseParams);
})
    ->method('GET|POST');
