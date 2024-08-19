<?php
    class Core{
        // URL format --> /controller/method/params
        protected $currentController ='Pages';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct(){
            // print_r($this->getURL()); 

            $url = $this->getURL();
            if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')){
                $this->currentController = ucwords($url[0]);

                //Unset the controller in the URL
                unset($url[0]);

                // call the controller
                require_once '../app/controllers/'.$this->currentController.'.php';

                //Instentiate the controller
                $this->currentController = new $this->currentController;

                //check whether the method exist in the controller or not
                if(isset($url[1])){
                    if(method_exists($this->currentController,$url[1])){
                        $this->currentMethod = $url[1];

                        unset($url[1]);
                    }
                }

                // Get parameter list
                $this->params =$url ? array_values($url) : [];

                //call method and pass the parameter list
                call_user_func_array([$this->currentController,$this->currentMethod], $this->params);
            }
        }

        public function getURL(){
            // if(isset($_GET["url"])){
            //     echo "<pre>";
            //     echo $_GET["url"];
            //     echo "</pre>";
            // } else {
            //     echo "URL parameter not set.";
            // }
            // exit;
            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url,FILTER_SANITIZE_URL);
                $url = explode('/', $url);

                return $url;
            }
        }
    }
?>