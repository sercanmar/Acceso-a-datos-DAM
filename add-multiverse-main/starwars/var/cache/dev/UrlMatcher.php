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
        '/characters' => [
            [['_route' => 'app_characters_all', '_controller' => 'App\\Controller\\CharactersController::all'], null, null, null, false, false, null],
            [['_route' => 'characters', '_controller' => 'App\\Controller\\CharactersController::all'], null, null, null, false, false, null],
        ],
        '/deaths' => [
            [['_route' => 'app_deaths_all', '_controller' => 'App\\Controller\\DeathsController::all'], null, null, null, false, false, null],
            [['_route' => 'deaths', '_controller' => 'App\\Controller\\DeathsController::all'], null, null, null, false, false, null],
        ],
        '/films' => [
            [['_route' => 'app_films_all', '_controller' => 'App\\Controller\\FilmsController::all'], null, null, null, false, false, null],
            [['_route' => 'films', '_controller' => 'App\\Controller\\FilmsController::all'], null, null, null, false, false, null],
        ],
        '/planets' => [
            [['_route' => 'app_planets_all', '_controller' => 'App\\Controller\\PlanetsController::all'], null, null, null, false, false, null],
            [['_route' => 'planets', '_controller' => 'App\\Controller\\PlanetsController::all'], null, null, null, false, false, null],
        ],
        '/affiliations' => [[['_route' => 'affiliations', '_controller' => 'App\\Controller\\AffiliationsController::all'], null, null, null, false, false, null]],
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
                .'|/affiliation/([^/]++)(*:190)'
                .'|/character(?'
                    .'|s/(?'
                        .'|([^/]++)(*:224)'
                        .'|death/([^/]++)(*:246)'
                    .')'
                    .'|/([^/]++)(*:264)'
                .')'
                .'|/deaths/([^/]++)(*:289)'
                .'|/films/([^/]++)(*:312)'
                .'|/planets/([^/]++)(*:337)'
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
        190 => [[['_route' => 'affiliations_id', '_controller' => 'App\\Controller\\AffiliationsController::getAffiliation'], ['id'], null, null, false, true, null]],
        224 => [[['_route' => 'characters_id', '_controller' => 'App\\Controller\\CharactersController::getCharacter'], ['id'], null, null, false, true, null]],
        246 => [[['_route' => 'characters_death', '_controller' => 'App\\Controller\\CharactersController::getCharacter_death'], ['episode'], null, null, false, true, null]],
        264 => [[['_route' => 'characters_jedi', '_controller' => 'App\\Controller\\CharactersController::getCharacter_Order'], ['order'], null, null, false, true, null]],
        289 => [[['_route' => 'deaths_id', '_controller' => 'App\\Controller\\DeathsController::getDeath'], ['id'], null, null, false, true, null]],
        312 => [[['_route' => 'films_id', '_controller' => 'App\\Controller\\FilmsController::getFilm'], ['id'], null, null, false, true, null]],
        337 => [
            [['_route' => 'planets_id', '_controller' => 'App\\Controller\\PlanetsController::getPlanet'], ['id'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
