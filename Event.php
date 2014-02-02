<?php

class System_Event {
	
	private $_collection;
	
	public function __construct() {
		$this->_collection = array();
	}
	
	public function add($callback) {
		if(!is_callable($callback))
			throw new System_ArgumentOutOfRangeException('callback', 'Se esperaba un delegado', $callback);
		$this->_collection[] = $callback;
	}
	
	public function remove($callback) {
		if($key = array_search($callback, $this->_collection))
			unset($this->_collection[$key]);
	}
	
	protected function getCollection() {
		return $this->_collection;
	}
	
}

class Event {
	private $name;    
	
	public function GetName() {
		return $this->name;
	}    
	
	public function __construct($name) {
		$this->name = $name;
	}
}

class EventCollection {
	private $events;
	
	public function __construct() {
		$this->events = new ArrayObject();
	}
	
	public function Add(Event $event) {
		if (!$this->Contains($event))
			$this->events->Append($event);
	}    
	
	public function Contains($event) {
		foreach ($this->events as $e)	{
			if ($e->GetName() == $event)
				return true;
		}
	}
}