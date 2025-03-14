<?php
class AutoLoader {

    //Auto-chargement de classes 
    //La fonction spl_autoload_register() enregistre un nombre quelconque de 
    // chargeurs automatiques, ce qui permet aux classes et aux interfaces 
    // d'être automatiquement chargées si elles ne sont pas définies 
    // actuellement. En enregistrant des autochargeurs, PHP donne une 
    // dernière chance d'inclure une définition de classe ou interface, 
    // avant que PHP n'échoue avec une erreur. 

    public function __construct() {
        spl_autoload_register( array($this, 'load') );
        // spl_autoload_register(array($this, 'loadComplete'));
    }

    // This method will be automatically executed by PHP whenever it encounters an unknown class name in the source code
    private function load($className) {

        // TODO : compute path of the file to load (cf. PHP function is_readable)
        // it is in one of these subdirectory '/classes/', '/model/', '/controller/'
        // if it is a model, load its sql queries file too in sql/ directory
        $paths = ['/classes/', '/model/', '/controller/'];

        foreach($paths as $path){ 
            $fullpath = __ROOT_DIR . $path . $className . ".class.php";
            // echo $fullpath;
            if (is_readable($fullpath)){
                require_once($fullpath);
            }
        }
        if(is_readable(__ROOT_DIR . "/sql/" . $className . ".sql.php")) {
            require_once(__ROOT_DIR . "/sql/" . $className . ".sql.php");
        }
    }
}

$__LOADER = new AutoLoader();