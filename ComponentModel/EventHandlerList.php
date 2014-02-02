<?php

class System_ComponentModel_EventHandlerList {
	private $handlers;    
	
	public function __construct() {
		$this->handlers = new ArrayObject();
	}    
	
	public function Add(System_EventHandler $handler) {
		$this->handlers->Append($handler);
	}    
	
	public function RaiseEvent($event, $sender, $args) {
		foreach ($this->handlers as $handler) {
			if ($handler->GetEventName() == $event)
				$handler->Raise($sender, $args);
		}
	}
}