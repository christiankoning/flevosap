<?php

class Routes
{
    protected $routes = [];

    public function define($routes) {

        foreach ($routes as $key => $route) {
            if (empty($routes[Request::buildUri($key)])) {
                $routes[Request::buildUri($key)] = $routes[$key];
                unset($routes[$key]);
            }
        }
        $this->routes = $routes;
    }

    public function direct($uri) {
        if (array_key_exists($uri, $this->routes)) :
            if ($this->routes[$uri][1] == 2) {
                if (Auth::isAdmin()) {
                    return $this->routes[$uri][0];
                }
                else {
                    header('Location: '.Request::buildUri( '/'));
                }
            }
            elseif ($this->routes[$uri][1] == 1) {
                if (Auth::isLoggedIn()) {
                    return $this->routes[$uri][0];
                }
                else {
                    header('Location: '.Request::buildUri( '/login'));
                }
            }
            else {
                return $this->routes[$uri][0];
            }


        endif;

        throw new Exception('No route defined!');
    }
}