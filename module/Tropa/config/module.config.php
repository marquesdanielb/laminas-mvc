<?php

declare(strict_types=1);

namespace Tropa;

use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Tropa\Model\SetorTable;
use Laminas\Db\ResultSet\ResultSet;
use Tropa\Model\Setor;
use Laminas\Db\TableGateway\TableGateway;

return [
    'router' => [
        'routes' => [
            'tropa' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/tropa[/:controller[/:action]]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'aliases' => [
            'setor' => Controller\SetorController::class
        ],
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            Controller\SetorController::class => function($sm){
                $table = $sm->get(SetorTable::class);
                return new Controller\SetorController($table);
            }
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'tropa/index/index' => __DIR__ . '/../view/tropa/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'service_manager' => [
        'factories' => [
            SetorTable::class => function($sm) {
                $tableGateway = $sm->get('SetorTableGateway');
                $table = new SetorTable($tableGateway);
                return $table;
            },
            'SetorTableGateway' => function($sm) {
                $dbAdapter = $sm->get('Laminas\Db\Adapter');
                $resultSetPrototype = new ResultSet();
                $resultSetPrototype->setArrayObjectPrototype(new Setor());

                return new TableGateway('setor', $dbAdapter, null, $resultSetPrototype);
            }
        ],
    ],
];
