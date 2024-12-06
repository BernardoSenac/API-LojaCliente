<?php
    class Router {
        private array $routes;

        public function __construct() {
            $this->routes = [
                'GET' => [
                    '/pedidos' => [
                        'controller' => 'OrderController',
                        'function' => 'getOrders'
                    ],
                    '/clientes' => [
                        'controller' => 'ClientController',
                        'function' => 'getClients'
                    ]
                ],
                'POST' => [
                    '/pedido' => [
                        'controller' => 'OrderController',
                        'function' => 'createOrder'
                    ],
                    '/cliente' => [
                        'controller' => 'ClientController',
                        'function' => 'createClient'
                    ]
                ],
                'PUT' => [
                    '/cliente' => [
                        'controller' => 'ClientController',
                        'function' => 'updateClient'
                    ]
                ],
                'DELETE' => [
                ]
            ];
        }

        public function handleRequest(string $method, string $route): string {
            $route = explode('?', $route)[0];
        
            $routeExists = !empty($this->routes[$method][$route]);
        
            if (!$routeExists) {
                return json_encode([
                    'error' => 'Essa rota não existe!' . $route,
                    'result' => null
                ]);
            }
        
            $routeInfo = $this->routes[$method][$route];
        
            $controller = $routeInfo['controller'];
            $function = $routeInfo['function'];
        
            require_once __DIR__ . '/../controllers/' . $controller . '.php';
        
            return (new $controller)->$function();
        }
        
    }
?>