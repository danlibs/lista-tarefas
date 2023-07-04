<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index', ['as' => 'home']);
$routes->get('/api/tarefas', 'Tarefa::getAll', ['as' => 'tarefa.getAll']);
$routes->post('/api/tarefas', 'Tarefa::save', ['as' => 'tarefa.save']);
$routes->delete('/api/tarefas', 'Tarefa::deleteAll', ['as' => 'tarefa.deleteAll']);
$routes->delete('/api/tarefas/(:num)', 'Tarefa::deleteId/$1', ['as' => 'tarefa.deleteId']);
$routes->put('/api/tarefas/(:num)', 'Tarefa::edit/$1', ['as' => 'tarefa.edit']);
$routes->get('/login', 'Login::index', ['as' => 'login']);
$routes->post('/login', 'Login::signIn', ['as' => 'login.signIn']);
$routes->post('/logout', 'Login::logout', ['as' => 'login.logout']);
$routes->get('/cadastro', 'Usuario::index', ['as' => 'cadastro']);
$routes->post('/cadastro', 'Usuario::save', ['as' => 'usuario.save']);
$routes->delete('/cadastro', 'Usuario::delete', ['as' => 'usuario.delete']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
