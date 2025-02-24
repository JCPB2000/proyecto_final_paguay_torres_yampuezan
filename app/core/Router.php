<?php
class Router {
    private $routes = [];

    // Agregar una nueva ruta al router
    public function add($route, $controller, $method, $httpMethod = "GET") {
        $this->routes[$httpMethod][$route] = ['controller' => $controller, 'method' => $method];
    }

    // Despachar la solicitud según la URL
    public function dispatch($url) {
        $httpMethod = $_SERVER['REQUEST_METHOD'];

        if (!isset($this->routes[$httpMethod])) {
            http_response_code(404);
            echo json_encode(["success" => false, "message" => "Método HTTP no permitido"]);
            return;
        }

        foreach ($this->routes[$httpMethod] as $route => $action) {
            $pattern = preg_replace('/\{([a-z]+)\}/', '([0-9]+)', $route);
            if (preg_match("#^$pattern$#", $url, $matches)) {
                require_once __DIR__ . "/../controllers/" . $action['controller'] . ".php";
                $controller = new $action['controller']();
                array_shift($matches);
                call_user_func_array([$controller, $action['method']], $matches);
                return;
            }
        }

        // Si no se encuentra la ruta, devolver un error 404
        http_response_code(404);
        echo json_encode(["success" => false, "message" => "Ruta no encontrada"]);
    }
}
?>
