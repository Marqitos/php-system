<?php

class System_Array {
	
	public static function getValueNewGuid(array $self, $key) {
		$id = isset($self[$key])?
			new System_Guid($self[$key]):
			null;
		if(System_Guid::isEmpty($id))
			$id = System_Guid::NewGuid();
		return $id->getHex();
	}
	public static function getValueNullGuid(array $self, $key) {
		$id = isset($self[$key])?
			new System_Guid($self[$key]):
			null;
		return System_Guid::isEmpty($id)?
			null:
			$id->getHex();
	}
	public static function getValueGuid(array $self, $key) {
		$id = isset($self[$key])?
			new System_Guid($self[$key]):
			null;
		if(System_Guid::isEmpty($id))
			throw new System_ArgumentNullException($key);
		return $id->getHex();
	}
	public static function getValueNotNull(array $self, $key) {
		if(!isset($self[$key]))
			throw new System_ArgumentNullException($key);
		return $self[$key];
	}
	public static function getValueNull(array $self, $key) {
		return isset($self[$key])?
			$self[$key]:
			null;
	}
	public static function getValueNowDate(array $self, $key) {
		return isset($self[$key])?
			$self[$key]:
			time();
	}
	
}