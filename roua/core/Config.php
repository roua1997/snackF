<?php
  class Config {
		private static $instance = NULL;
		public static function getConnection() {
			if (!isset(self::$instance)) {
				try{
				    self::$instance = new PDO("mysql:host=localhost;dbname=rouadb", 'root', '');
					self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				}catch(Exception $e){
				    die('Erreur: '.$e->getMessage());
				}
			}
		return self::$instance;
		}
		public static function getUserSession(){
			if(!isset($_SESSION))
			{
				session_start();
			}
			if(!isset($_SESSION["name"])) {
				return null;
			}else{
				$id = $_SESSION["id"];
				$user = (new UserController())->findUserById($id);
				return $user;
			}
		}

	  public static function setUserSession(User $user){
		  if(!isset($_SESSION))
		  {
			  session_start();
		  }
		  $_SESSION["id"] = $user->getId();
		  $_SESSION["name"] = $user->getName();
		  $_SESSION["surname"] = $user->getSurname();
		  $_SESSION["username"] = $user->getUsername();
		  $_SESSION["email"] = $user->getEmail();
		  $_SESSION["password"] = $user->getPassword();
		  $_SESSION["role"] = $user->getRole();
		  $_SESSION["fidelity"] = $user->getFidelity();
		  $_SESSION["number"] = $user->getNumber();
	  }

	  public static function unsetSession(){
		  if(!isset($_SESSION))
		  {
			  session_start();
		  }
		  unset($_SESSION["id"]);
		  unset($_SESSION["name"]);
		  unset($_SESSION["surname"]);
		  unset($_SESSION["username"]);
		  unset($_SESSION["email"]);
		  unset($_SESSION["password"]);
		  unset($_SESSION["role"]);
		  unset($_SESSION["fidelity"]);
		  unset($_SESSION["number"]);
	  }
  }
