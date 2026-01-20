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
        '/provincias' => [
            [['_route' => 'app_provincia_provincias', '_controller' => 'App\\Controller\\ProvinciaController::provincias'], null, null, null, false, false, null],
            [['_route' => 'app_provincias', '_controller' => 'App\\Controller\\ProvinciaController::provincias'], null, null, null, false, false, null],
        ],
        '/centres' => [[['_route' => 'app_centres', '_controller' => 'App\\Controller\\CentreController::centres'], null, null, null, false, false, null]],
        '/centresValencia' => [[['_route' => 'app_centres_valencia', '_controller' => 'App\\Controller\\CentreController::centresValencia'], null, null, null, false, false, null]],
        '/newCentre' => [[['_route' => 'app_centres_new', '_controller' => 'App\\Controller\\CentreController::newCentre'], null, null, null, false, false, null]],
        '/centre-provincia' => [[['_route' => 'app_centre_provincia', '_controller' => 'App\\Controller\\CentreController::centresProvincia'], null, null, null, false, false, null]],
        '/cicles' => [[['_route' => 'app_cicles', '_controller' => 'App\\Controller\\CicleController::cicles'], null, null, null, false, false, null]],
        '/newCicle' => [[['_route' => 'app_cicle_new', '_controller' => 'App\\Controller\\CicleController::newCicle'], null, null, null, false, false, null]],
        '/newProvincia' => [[['_route' => 'app_provincia_new', '_controller' => 'App\\Controller\\ProvinciaController::newProvincia'], null, null, null, false, false, null]],
        '/regims' => [[['_route' => 'app_regims', '_controller' => 'App\\Controller\\RegimController::regims'], null, null, null, false, false, null]],
        '/newRegim' => [[['_route' => 'app_regim_new', '_controller' => 'App\\Controller\\RegimController::newRegim'], null, null, null, false, false, null]],
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
                .'|/c(?'
                    .'|entre(?'
                        .'|/([^/]++)(*:191)'
                        .'|\\-cicle/([^/]++)/([^/]++)(*:224)'
                    .')'
                    .'|icle/([^/]++)(*:246)'
                .')'
                .'|/update(?'
                    .'|C(?'
                        .'|entre/([^/]++)(*:283)'
                        .'|icle/([^/]++)(*:304)'
                    .')'
                    .'|Provincia/([^/]++)(*:331)'
                    .'|Regim/([^/]++)(*:353)'
                .')'
                .'|/delete(?'
                    .'|C(?'
                        .'|entre/([^/]++)(*:390)'
                        .'|icle/([^/]++)(*:411)'
                    .')'
                    .'|Provincia/([^/]++)(*:438)'
                    .'|Regim/([^/]++)(*:460)'
                .')'
                .'|/provincia/([^/]++)(*:488)'
                .'|/regim/([^/]++)(*:511)'
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
        191 => [[['_route' => 'app_centre', '_controller' => 'App\\Controller\\CentreController::centre'], ['id'], null, null, false, true, null]],
        224 => [[['_route' => 'app_centres_cicle', '_controller' => 'App\\Controller\\CentreController::addCicleCentre'], ['centreId', 'cicleId'], null, null, false, true, null]],
        246 => [[['_route' => 'app_cicle', '_controller' => 'App\\Controller\\CicleController::cicle'], ['id'], null, null, false, true, null]],
        283 => [[['_route' => 'app_centres_update', '_controller' => 'App\\Controller\\CentreController::updateCentre'], ['id'], null, null, false, true, null]],
        304 => [[['_route' => 'app_cicle_update', '_controller' => 'App\\Controller\\CicleController::updateCicle'], ['id'], null, null, false, true, null]],
        331 => [[['_route' => 'app_provincia_update', '_controller' => 'App\\Controller\\ProvinciaController::updateProvincia'], ['id'], null, null, false, true, null]],
        353 => [[['_route' => 'app_regim_update', '_controller' => 'App\\Controller\\RegimController::updateRegim'], ['id'], null, null, false, true, null]],
        390 => [[['_route' => 'app_centres_delete', '_controller' => 'App\\Controller\\CentreController::deleteCentre'], ['id'], null, null, false, true, null]],
        411 => [[['_route' => 'app_cicle_delete', '_controller' => 'App\\Controller\\CicleController::deleteCicle'], ['id'], null, null, false, true, null]],
        438 => [[['_route' => 'app_provincia_delete', '_controller' => 'App\\Controller\\ProvinciaController::deleteProvincia'], ['id'], null, null, false, true, null]],
        460 => [[['_route' => 'app_regim_delete', '_controller' => 'App\\Controller\\RegimController::deleteRegim'], ['id'], null, null, false, true, null]],
        488 => [[['_route' => 'app_provincia', '_controller' => 'App\\Controller\\ProvinciaController::provincia'], ['id'], null, null, false, true, null]],
        511 => [
            [['_route' => 'app_regim', '_controller' => 'App\\Controller\\RegimController::regim'], ['id'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
