<?php
use PR\Form\Type\DeveloperType;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

use Silex\Application;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\WebProfilerServiceProvider;
use Silex\Provider\FormServiceProvider;


$app          = new Application();
$app['debug'] = true;

$app->register(new HttpFragmentServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new UrlGeneratorServiceProvider());

$app->register(new TwigServiceProvider(), [
    'twig.path' => __DIR__ . '/../src/PR/views',
]);

$app->register(new WebProfilerServiceProvider(), array(
    'profiler.cache_dir' => __DIR__ . '/../app/cache/profiler'
));

$app->register(new FormServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new TranslationServiceProvider(), array(
    'locale_fallbacks' => array('en'),
));

$app['form.types'] = $app->share($app->extend('form.types', function ($types) {
    $types[] = new DeveloperType();

    return $types;
}));

$paths     = [__DIR__ . '/../src'];
$isDevMode = true;

// the connection configuration
$dbParams = [
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => null,
    'dbname'   => 'local'
];

$config        = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);


//$app['form.extensions'] = $app->share($app->extend('form.extensions', function ($extensions) use ($app, $entityManager) {
//    $managerRegistry = new ManagerRegistry(null, [$entityManager->getConnection()], [], null, null, '\Doctrine\ORM\Proxy\Proxy');
//    $managerRegistry->setContainer($app);
//    $extensions[] = new DoctrineOrmExtension($managerRegistry);
//
//    return $extensions;
//}));
