<?php

class Image extends Eloquent {
	
	public function user() {
		
		# Images belong to users
		return $this->belongsTo('User');
	
	}
}