<?php

class Part extends Eloquent {
	
	public function user() {
		
		return $this->belongsTo('User');
	
	}
}