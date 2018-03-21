<?php

	$badChars = array("!", "@", "#", "\$", "%", "^", "&", "*", "(", ")", "+", "=", "`", "~", ".", ",", ";", ":", "/", "\"", "'", "\\", "<", ">", "?", "|", "[", "]", "{", "}");

	function addSpacingByCamelCase($string) {
		$spacedString = "";

		$charArray = str_split($string);
		foreach($charArray as $key => $value)
			if(!isUpperCase($value))
				$spacedString .= $value;
			else
				$spacedString .= " " . $value;

		return $spacedString;
	}


	// String param must already be Camel Case
	function addSpacingNormal($string) {
		$spacedString = "";

		$charArray = str_split($string);
		foreach($charArray as $key => $value)
			if(!isUpperCase($value))
				$spacedString .= $value;
			else
				$spacedString .= " " . $value;

		return ucfirst($spacedString);
	}

	function removeSpacingAddCamelCase($string) {
		return str_replace(" ", "", lcfirst( ucwords( strtolower($string) ) ));
	}

	function isUpperCase($char) {
		return ctype_upper($char);
	}

	function removeDirectoryRecursively($filePath) {
		$files = new DirectoryIterator($filePath);

		foreach($files as $file)
		    if($file -> isFile())
		        unlink($file -> getRealPath());
		    else if(!$file -> isDot() && $file -> isDir())
		        removeDirectoryRecursively($file -> getRealPath());

		rmdir($filePath);
	}

	function getDirContents($dir, &$results = array()) {
	    $files = scandir($dir);

	    foreach($files as $key => $value) {
	        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
	        if(!is_dir($path)) {
	            $results[] = $path;
	        } else if($value !== "." && $value !== "..") {
	            getDirContents($path, $results);
	            $results[] = $path;
	        }
	    }

	    return $results;
	}

	// If filepath to .php file is found - filepath to file is returned, starting from "mainTabs/"
	function getFilepath($directory, $file) {

		function getDirContents_local($dir, &$results = array()) {
		    $files = scandir($dir);

		    foreach($files as $key => $value) {
		        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
		        if(!is_dir($path)) {
		            $results[] = $path;
		        } else if($value !== "." && $value !== "..") {
		            getDirContents_local($path, $results);
		            $results[] = $path;
		        }
		    }

		    return $results;
		}

		if(!empty($file) && substr($file, strlen($file) === ".php")) {
			$directoryContents = getDirContents_local($directory);
			$filepath = "";
			foreach($directoryContents as $key => $value) {
				if(strrpos($value, $file)) {
					$filepath = $directoryContents[$key];
				}
			}

			return substr($filepath, stripos($filepath, "modules/kb/") + 11);
		} else {
			return "Error: Not A Valid PHP File (Try \"getFolderpath()\")";
		}
		
	}

	function getFolderpath($directory, $folder) {
		function getDirContents_local($dir, &$results = array()) {
		    $files = scandir($dir);

		    foreach($files as $key => $value) {
		        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
		        if(!is_dir($path)) {
		            $results[] = $path;
		        } else if($value !== "." && $value !== "..") {
		            getDirContents_local($path, $results);
		            $results[] = $path;
		        }
		    }

		    return $results;
		}

		if(!empty($folder) && !stripos($folder, ".")) {
			$directoryContents = getDirContents_local($directory);
			$filepath = "";
			foreach($directoryContents as $key => $value) {
				if(strpos($value, $folder)) {
					$filepath = $directoryContents[$key];
				}
			}

			return substr($filepath, stripos($filepath, "modules/kb/") + 11);
		} else {
			return "Error: Not A Valid Folder (Try \"getFilepath()\")";
		}
	}

	function replaceInFile($filepath, $find, $replacement) {
		$reading = fopen($filepath, 'r');
		$writing = fopen($filepath . '.tmp', 'w');

		$replaced = false;

		while(!feof($reading)) {
			$line = fgets($reading);
			if(strstr($line, $find . PHP_EOL)) {
				$line = $replacement . PHP_EOL;
				$replaced = true;
			}
			fputs($writing, $line);
		}
		fclose($reading);
		fclose($writing);
		
		// Don't overwrite the file if we didn't replace anything
		if($replaced) {
			rename($filepath . '.tmp', $filepath);
		} else {
			unlink($filepath . '.tmp');
		}
	}

	function getWords($str) {
		$temp = preg_split('/(\s+)/', $str, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

		$spaces = array();
		$words = array_reduce( $temp, function( &$result, $item) use ( &$spaces) {
		    if( strlen( trim( $item)) === 0) {
		        $spaces[] = strlen( $item);
		    } else {
		        $result[] = $item;
		    }
		    return $result;
		}, array());

		return $words;
	}

?>