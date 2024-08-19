<?php
    class Pages extends Controller{
        public function __construct()
        {
            // echo 'this is the pages controller';
        }

        public function index(){

        }
        public function about($name, $age){
            $data = [
                'username' => $name,
                'userage'=> $age
            ];

            $this->view('v_about', $data);

        }
    }
?>