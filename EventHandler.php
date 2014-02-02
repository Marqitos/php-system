<?php

class System_EventHandler {
	private $event;
	private $callback;    
	
	public function GetEventName() {
		return $this->event->GetName();
	}    
	
	public function __construct(Event $event, $callback) {
		$this->event = $event;
		$this->callback = $this->PrepareCallback($callback);
	}    
	
	public function Raise($sender, $args) {
		if ($this->callback)
			eval($this->callback);
	}    
	
	private function PrepareCallback($callback) {
		if ($pos = strpos($callback, '('))
			$callback = substr($callback, 0, $pos);    
	
		$callback .= '($sender, $args);';         
		
		return $callback;
	}
}