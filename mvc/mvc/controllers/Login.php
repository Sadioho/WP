<?php
    class Login extends Controller{
        function PageLogin(){
           $this->view("login");
        }
        function PageRegister(){
            $this->view("Register");
          
        }
    }

?>