<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/usuarios' => [[['_route' => 'usuarios', '_controller' => 'App\\Controller\\UsuarioController::usuarios'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:102)'
                            .'|router(*:116)'
                            .'|exception(?'
                                .'|(*:136)'
                                .'|\\.css(*:149)'
                            .')'
                        .')'
                        .'|(*:159)'
                    .')'
                .')'
                .'|/usuarios/([^/]++)(?'
                    .'|(*:190)'
                    .'|/(?'
                        .'|p(?'
                            .'|lan(*:209)'
                            .'|remium(*:223)'
                            .'|agos(*:235)'
                        .')'
                        .'|configuracion(*:257)'
                    .')'
                .')'
                .'|/suscripciones/([^/]++)(*:290)'
            .')/?$}sD',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        102 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        116 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        136 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        149 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        159 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        190 => [[['_route' => 'usuario', '_controller' => 'App\\Controller\\UsuarioController::usuario'], ['id'], ['GET' => 0, 'PUT' => 1, 'DELETE' => 2], null, false, true, null]],
        209 => [[['_route' => 'Plan_usuario', '_controller' => 'App\\Controller\\UsuarioController::plan_usuario'], ['id'], null, null, false, false, null]],
        223 => [[['_route' => 'Activar_premium', '_controller' => 'App\\Controller\\UsuarioController::activar_premium'], ['id'], null, null, false, false, null]],
        235 => [[['_route' => 'Pago_usuario', '_controller' => 'App\\Controller\\UsuarioController::pago_usuario'], ['id'], null, null, false, false, null]],
        257 => [[['_route' => 'usuario_configuracion', '_controller' => 'App\\Controller\\UsuarioController::configuracion_usuario'], ['id'], ['GET' => 0, 'PUT' => 1], null, false, false, null]],
        290 => [
            [['_route' => 'Suscripcion_usuario', '_controller' => 'App\\Controller\\UsuarioController::suscripcion_usuario'], ['id'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
