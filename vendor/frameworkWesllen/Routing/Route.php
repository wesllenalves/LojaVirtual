<?php

namespace FrameworkWesllen\Routing;

use Klein\Klein as Klein;

class Route extends Klein {

    public function get($route = '*', $call = NULL) {
        if (is_string($call)) {
            $explode = explode("@", $call);

            $controller = "App\\Controllers\\" . $explode[0] . "Controller";
            $action = $explode[1];

            $this->respond("GET", $route, function($request, $response, $service, $app) use ($controller, $action) {

                $class = new $controller();
                $class->__LoadVars($request, $response, $service, $app);
                return $class->$action();
            });
        } else {
            $this->respond("GET", $route, $call);
        }
    }

    public function post($route = '*', $call = NULL) {

        if (is_string($call)) {

            $explode = explode("@", $call);
            $controller = "App\\Controllers\\" . $explode[0] . "Controller";
            $action = $explode[1];

            $this->respond("POST", $route, function($request, $response, $service, $app) use ($controller, $action) {

                $class = new $controller();
                $class->__LoadVars($request, $response, $service, $app);
                return $class->$action();
            });
        } else {
            $this->respond("POST", $route, $call);
        }
    }

}
