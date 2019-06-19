<?php
	// use this to convert object to array
	function objectToArray($stdObject) {
		if (is_object($stdObject)) {
			$stdObject = get_object_vars($stdObject);
		}
		if (is_array($stdObject)) {
			return array_map(__FUNCTION__, $stdObject);
		} else {
			// Return array
			return $stdObject;
		}
	}