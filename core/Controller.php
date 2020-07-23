<?php
class Controller {

    public function render($viewName, $viewData = array()) {

        extract($viewData);
        require 'src/views/'.$viewName.'.php';
    }

    public function loadTemplate($viewName, $viewData = array()) {
        require 'src/views/Template.php';
    }
}