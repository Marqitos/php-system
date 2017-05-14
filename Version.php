<?php

class System_Version {
	
	private $_major;
	private $_minor;
	private $_build;
	private $_revision;
	
	public function __construct($major, $minor = 0, $build = 0, $revision = 0) {
		if(is_string($major)) {
			$values = explode('.', $major, 4);
			$this->_major = intval($values[0]);
			if(isset($values[1]))
				$minor = $values[1];
			if(isset($values[2]))
				$build = $values[2];
			if(isset($values[3]))
				$revision = $values[3];
		} else
			$this->_major 		= intval($major);

		$this->_minor		= intval($minor);
		$this->_build		= intval($build);
		$this->_revision	= intval($revision);
	}
		
	public function getMajor() {
		return $this->_major;
	}
	
	public function getMinor() {
		return $this->_minor;
	}
	
	public function getBuild() {
		return $this->_build;
	}
	
	public function getRevision() {
		return $this->_revision;
	}
	
	public function __toString() {
		return ($this->_build != 0 && $this->_revision != 0)
			? $this->_major . '.' . $this->_minor . '.' . $this->_build . '.' . $this->_revision
			: $this->_major . '.' . $this->_minor;
	}
	
}
