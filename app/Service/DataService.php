<?php
namespace Service;

use \Exception\DataException;

class DataService {

	private $path = '/data/';

	private static $_instance = null;
	
	private function __construct($path) {
		if (!is_null($path)) {
			$this->path = $path;
		}
		else {
			$this->path = realpath("{$_SERVER["DOCUMENT_ROOT"]}/../data/");
		}
	}

	public static function getInstance($path = null) {
		if (is_null(self::$_instance)) {
			self::$_instance = new DataService($path);  
		}

		return self::$_instance;
	}

	public function path() { 
		return $this->path;
	}

	private function getTypePath($object) {
		$type = strtolower((new \ReflectionClass($object))->getShortName());
		$path = self::$_instance->path().'/';
		switch ($type) {
			case 'campus':
			case 'student':
				$path .= $type . '/';
				break;
			case 'internalteacher':
			case 'externalteacher':
				$path .= 'teacher/';
				break;
			default:
				throw new DataException(__METHOD__ . " : Invalid type data");
				break;
		}
		return $path;
	}

	public function save($object) {
		$json = json_encode($object, JSON_PRETTY_PRINT);
		try {
			file_put_contents($this->getTypePath($object) . hash('md5', $json), $json);
			return true;
		} catch (\Exception $e) {
			throw new DataException("into path ".self::$_instance->path().", {$e->getMessage()}");
		}
	}

	public function remove($object) {
		$json = json_encode($object, JSON_PRETTY_PRINT);
		$file = $this->getTypePath($object) . hash('md5', $json);
		if (file_exists($file)) {
			unlink($file);
			return true;
		}
		return false;
	}

	public function getAll($type) {
		$path = self::path().'/'.$type. '/';
		$return = array();
		if (is_dir($path)) {
			if ($dh = opendir($path)) {
		        while (($file = readdir($dh)) !== false) {
		        	if ($file !== '.' && $file !== '..' && filetype($path . $file) !== 'dir') {
		        		$return[] = (array) json_decode(file_get_contents($path . $file));
		        	}
		        }
		        closedir($dh);
		    }
		}
		else {
			throw new DataException("Type doesn't exist");
		}
		return json_encode($return, JSON_PRETTY_PRINT);
	}
}