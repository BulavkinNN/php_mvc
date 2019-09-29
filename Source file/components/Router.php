<?php


class Router
{
    private $routes;

    public function __construct(){
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include ($routesPath);
        }

    /** return url for controllers
     * @return string
     */
     private function getURI(){
         if (!empty($_SERVER['REQUEST_URI'])){
           return  trim($_SERVER['REQUEST_URI'],'/');
         }
         return null;
     }

    public function run(){
        echo 'Class router - run!';
        print_r($this->routes);
        $uri = $this->getURI();
        echo $uri;

        foreach ($this->routes as $uriPattern => $path){
            echo "<br> $uriPattern -> $path";
            if (preg_match("~^$uriPattern$~",$uri)){
                $segments = explode("/", $path);
                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);
                echo $controllerName;
                $activeName = 'action'.ucfirst(array_shift($segments));
                echo $activeName;
                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';
                if (file_exists($controllerFile)){
                    include_once ($controllerFile);
                    $controllerObject = new $controllerName;
                    $result = $controllerObject->$activeName ();
                    if ($result != null){
                        break;
                    }
                }

            }
        }
    }
}