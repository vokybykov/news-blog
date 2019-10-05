<?php
	namespace App\Core;
	
	use Exception;
	
	class View {
		
		public static function render($view, $arr) {
			foreach ($arr as $varName => $value) {
				$$varName = $value;
			}
			$file = self::getFile($view);
			if($file) {
				include $file;
			} else {
				throw new Exception("View '".$view."' not found");
			}
		}
		
		public static function redirectTo($uri) {	
			$host = $_SERVER['HTTP_HOST'];
			header("Location: http://$host$uri"); 
			exit;
		}
		
		private static function getFile($view) {
			$file = __DIR__.'/../views/'.str_replace('.', '/', $view).'.php';
			if(file_exists($file)) {
				return $file;
			}
		}
	}