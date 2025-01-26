<?php

namespace App\Core;


class Router
{
    protected $routes = [];

    public function add($method, $uri, $controller, $action)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'action' => $action,
            'method' => $method
        ];

        return $this;
    }

    public function get($uri, $controller, $action)
    {
        $this->add('GET', $uri, $controller, $action);
    }

    public function post($uri, $controller, $action)
    {
        $this->add('POST', $uri, $controller, $action);
    }

    public function delete($uri, $controller, $action)
    {
        $this->add('DELETE', $uri, $controller, $action);
    }

    public function put($uri, $controller, $action)
    {
        $this->add('PUT', $uri, $controller, $action);
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            // Check for exact match
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                return $this->executeControllerAction($route);
            }
            
            // Check for dynamic routes
            $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9_]+)', $route['uri']);
            if (preg_match('#^' . $pattern . '$#', $uri, $matches) && $route['method'] === strtoupper($method)) {
                array_shift($matches); 
                return $this->executeControllerActionWithParams($route, $matches);
            }
        }
    
        $this->abort("No such route registered", 404);
    }

    
    private function executeControllerAction($route)
    {
        if (class_exists($route['controller'])) {
            $controller = new $route['controller'];
    
            if (method_exists($controller, $route['action'])) {
                return $controller->{$route['action']}();
            } else {
                $this->abort("Action ({$route['action']}) not found", 404);
            }
        } else {
            $this->abort("Controller not found", 404);
        }
    }
    

    private function executeControllerActionWithParams($route, $params)
    {
        if (class_exists($route['controller'])) {
            $controller = new $route['controller'];
    
            if (method_exists($controller, $route['action'])) {
                return $controller->{$route['action']}(...$params); 
            } else {
                $this->abort("Action ({$route['action']}) not found", 404);
            }
        } else {
            $this->abort("Controller not found", 404);
        }
    }


    protected function abort($message, $code = 404)
    {
        http_response_code($code);
        echo $code .": " . $message;
        die();
    }
}
