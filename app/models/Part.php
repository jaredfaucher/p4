<?php

class Part extends Eloquent {
	
	public function user() {
		
		# Parts belong to users
		return $this->belongsTo('User');
	
	}
}