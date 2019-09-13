<?php
class User {
    var $name;
    var $email;
	var $adress;	
   
    function __construct($name, $email, $adress) {
       $this->$name = $name;
	   $this->$email = $email;
	   $this->$adress = $adress;
   }

	function getName($name) {
		$this->$name = $name;
	}
	function getEmail($email) {
		$this->$email = $email;
	}
	function getAdress($adress) {
		$this->$adress = $adress;
	}	
}
?>