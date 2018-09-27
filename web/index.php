<?php

use app\actions\IndexAction;
use app\actions\task\IndexAction as TaskIndexAction;
use app\actions\task\UpdateAction as TaskUpdateAction;
use app\actions\task\ViewAction as TaskViewAction;
use app\actions\task\CreateAction as TaskCreateAction;
use app\helpers\EntityManagerBuilder;
use app\http\entities\request\RequestFactory;
use app\http\router\entities\route\Handler;
use app\http\router\entities\route\Path;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\SimplifiedYamlDriver;

require dirname(__DIR__) . '/vendor/autoload.php';

$runtime = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'runtime';
$models = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'src/models';

$pdo = new PDO(
    'sqlite:' . $runtime . '/db/db.sqlite'
);

$container = new \League\Container\Container();

$container->delegate(
    new League\Container\ReflectionContainer
);

$container->add(\app\http\router\RouterInterface::class, \app\http\router\LeagueRouterAdapter::class)->addArgument(new \League\Route\Router());
$container->add(\app\http\emitter\EmitterInterface::class, \app\http\emitter\Emitter::class);
$container->add(\app\http\renderer\RendererInterface::class, \app\http\renderer\Renderer::class)->addArgument('views')->addArgument('main');
$container->add(\app\http\middleware\BasicAuthMiddleware::class, \app\http\middleware\BasicAuthMiddleware::class)->addArgument([
    '/task/update' => [
        'username' => 'admin',
        'password' => '1234',
    ],
])->addArgument(new \app\http\entities\response\Response());

$container->add(EntityManager::class, function () use ($pdo, $runtime, $models) {
    return (new EntityManagerBuilder())
        ->withProxyDir($runtime . '/proxy', 'Proxies', true)
        ->withMapping(new SimplifiedYamlDriver([
            $models . '/task/mapping' => 'app\models\task',
        ]))

        ->withCache(new FilesystemCache($runtime . '/cache'))
        ->withTypes([
            \app\models\task\types\IdType::NAME => \app\models\task\types\IdType::class,
            \app\models\task\types\UserType::NAME => \app\models\task\types\UserType::class,
            \app\models\task\types\EmailType::NAME => \app\models\task\types\EmailType::class,
            \app\models\task\types\DescriptionType::NAME => \app\models\task\types\DescriptionType::class,
            \app\models\task\types\ImageType::NAME => \app\models\task\types\ImageType::class,
            \app\models\task\types\DoneType::NAME => \app\models\task\types\DoneType::class,
        ])
        ->withAutocommit(true)
        ->build(['pdo' => $pdo]);
});


/** @var EntityManager $em */
$em = $container->get(EntityManager::class);

$container->add(
    \app\repositories\task\RepositoryInterface::class,
    \app\repositories\task\DoctrineRepository::class
)
    ->addArgument($em)
    ->addArgument($em->getRepository(\app\models\task\Task::class));

/** @var \app\http\Application $application */
$application = $container->get(\app\http\Application::class);

$application->get(new Path('/'), new Handler($container->get(IndexAction::class)));
$application->get(new Path('/tasks'), new Handler($container->get(TaskIndexAction::class)));
$application->get(new Path('/tasks/{page}'), new Handler($container->get(TaskIndexAction::class)));
$application->get(new Path('/task/create'), new Handler($container->get(TaskCreateAction::class)));
$application->post(new Path('/task/create'), new Handler($container->get(TaskCreateAction::class)));
$application->get(new Path('/task/update/{id}'), new Handler($container->get(TaskUpdateAction::class)));
$application->post(new Path('/task/update/{id}'), new Handler($container->get(TaskUpdateAction::class)));
$application->get(new Path('/task/{id}'), new Handler($container->get(TaskViewAction::class)));

$application->pipe($container->get(\app\http\middleware\BasicAuthMiddleware::class));

$response = $application->run(RequestFactory::fromGlobals());

