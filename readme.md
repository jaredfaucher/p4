# README - P4 - Jared Faucher

## Live URL:
	http://p4-jaredf.rhcloud.com/

## Description:
	My project, Bike Swap, is a web application that helps cycling enthusiasts connect to try out, buy, sell and trade bike parts within their community.  The user is able to register, log in, create a personal profile where they can upload pictures and add/remove parts from their database as well as search for user's near them and search for parts.  When a user is interested in another user's parts they can request the part by a form which emails their information and what part they are interested in to the other user.
	
## Details:

	User must register with a username, email, Zip Code and password before having access to the site.  Feel free to sign up yourself but I have seeded the database and provided the following login information:
		-Username
		-Email
		-Zip Code
		-Password

	The files "image_helper.php" and "search_helper.php" located in app/controllers/helpers are used to reduce repetition within the controllers.  The file "image_helper.php" is used to connect to the Imgur API before attempting to upload the file.  The "seach_helper.php" contains two functions needed to distance between two Zip Codes. The first function "getCoordinates" taps into Google Geocoding API, getting a JSON file and parses the file to obtain the lat/long coordinates for the two Zip Codes. The second function "calculateDistance" is adapted from the link below and calculates the distance in miles between two lat/long coordinates obtained in the previous function

## Plugins/Libraries/Etc:
	-Bootstrap:  http://getbootstrap.com/
	-Laravel 4 Debugbar:  https://github.com/barryvdh/laravel-debugbar
	-PHP Imgur API Client:  https://github.com/Adyg/php-imgur-api-client/tree/master
	-Imgur API:  https://api.imgur.com/
	-Google Geocoding API: https://developers.google.com/maps/documentation/geocoding/  
	-Distance Formula: http://www.techrecite.com/distance-formula-in-php-calculate-distance-between-two-points-programmatically/
	-Reddit:  Asked users on Reddit for their bike builds in order to seed my database
