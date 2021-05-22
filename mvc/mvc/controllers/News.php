<?php
    class News extends Controller{
        function PageLogin(){
            echo "Login New";
        }
        function Show($ho,$ten){
         $name=$this->model("SinhVienModel");
         echo $name->Tong($ho,$ten);
        }
    }  

?>