<?php

class System_EventHandlerList
	extends System_Event {
	
	public function invoke() {
		$cancel = false;
		$args = func_get_args();
		foreach($this->getCollection() as $callback)
			$cancel |= call_user_func_array($callback, $args);
	}
		
}

