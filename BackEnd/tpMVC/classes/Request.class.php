<?php
class Request {

	protected $controllerName;
	protected $uriParameters;
    public $baseURI;
    private static $request = null;


    public static function getCurrentRequest(){
       // pour ne pas recréer l'objet à chaque instance de la classe Request
       if(is_null(static::$request))
            static::$request =  new self();
        return static::$request;
    }

   public function __construct() {
      $this->initBaseURI();
      $this->initControllerAndParametersFromURI();
   }

   // intialise baseURI
   // e.g. http://eden.imt-nord-europe.fr/~luc.fabresse/api.php => __BASE_URI = /~luc.fabresse
   // e.g. http://localhost/CDAW/api.php => __BASE_URI = /CDAW
   protected function initBaseURI() {
        $uri = $_SERVER['REQUEST_URI'];
        $parsedUri = parse_url($uri);
        $pathUri = isset($parsedUri['path']) ? $parsedUri['path'] : '';
        $this->baseURI = dirname($pathUri);
    }


   // intialise controllerName et uriParameters
   // controllerName contient chaîne 'default' ou le nom du controleur s'il est présent dans l'URI (la requête)
   // uriParameters contient un tableau vide ou un tableau contenant les paramètres passés dans l'URI (la requête)
   // e.g. http://eden.imt-nord-europe.fr/~luc.fabresse/api.php
   //    => controllerName == 'default'
   //       uriParameters == []
   // e.g. http://eden.imt-nord-europe.fr/~luc.fabresse/api.php/user/1
   //    => controllerName == 'user'
   //       uriParameters == [ 1 ]
   //
   // Aide :
   // En utlisant la fonction PHP phpinfo et en faisant des tests
   // http://localhost/info.php/test/test
   // on peut voir que
   // $_SERVER['SCRIPT_NAME'] donne le préfixe
   // et que parse_url($_SERVER['REQUEST_URI']
   protected function initControllerAndParametersFromURI(){

      // $this->controllerName = TODO
      // $this->uriParameters = TODO
    }

   // ==============
   // Public API
   // ==============

	// retourne le name du controleur qui doit traiter la requête courante
   public function getControllerName() {
      return $this->controllerName;
   }

	// retourne la méthode HTTP utilisée dans la requête courante
   public function getHttpMethod() {
      return $_SERVER["REQUEST_METHOD"];
   }


}
