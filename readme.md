# README - P4 - Jared Faucher

## Live URL:
[http://p4-jaredf.rhcloud.com/](http://p4-jaredf.rhcloud.com/)

## Description:
My project, Bike Swap, is a web application that helps cycling enthusiasts connect to try out, buy, sell and trade bike parts within their community.  The user is able to register, log in, create a personal profile where they can upload pictures and add/remove parts from their database as well as search for user's near them and search for parts.  When a user is interested in another user's parts they can request the part by a form which emails their information and what part they are interested in to the other user.
	
## Details:

User must register with a username, email, Zip Code and password before having access to the site.  Feel free to sign up yourself but I have seeded the database and provided the following login information:
	-Username: JaredFaucher
	-Email: jared.faucher@gmail.com (my email)
	-Zip Code: 02145
	-Password: password
There are also additional login/part/image information in the app/database/seeds folder but the other users I created have fake email addresses.

My web application has the following features
	-Registering:  
		User is able to sign up for the app and receives a confirmation email upon creation of the account.
	-Login/Authentication:  
		User must log in before viewing anyone's profiles and before searching for parts.  I also provided a forgotten password reset process which emails the user a link to reset their password.  This is included in Laravel but I had to tweak it a bit for my purposes.
	-Profile page:  
		User has the ability to add/remove parts and images from their profile, change their email, password and zip code and set a default profile picture.
		If on another user's profile then the user has the ability to view their pictures and parts.  They are also able to use a form to request a part from the user, which emails the other user with their contact information so they may respond if interested.
	-Search:
		User as the ability to search for parts by their name/description and is able to filter their search by part type.
		User has the ability to look for all users within a 5, 10, 25 and 50 mile radius.  The user can also seach for a user by their username.

The files "image_helper.php" and "search_helper.php" located in app/controllers are used to reduce repetition within the controllers.  The file "image_helper.php" is used to connect to the Imgur API before attempting to upload the file.  The "seach_helper.php" contains two functions needed to distance between two Zip Codes. The first function "getCoordinates" taps into Google Geocoding API, getting a JSON file and parses the file to obtain the lat/long coordinates for the two Zip Codes. The second function "calculateDistance" is adapted from the link below and calculates the distance in miles between two lat/long coordinates obtained in the previous function.

## Plugins/Libraries/Etc:
-Bootstrap:  Used for boiler plate stylization.
	-http://getbootstrap.com/
-Laravel 4 Debugbar:  Used for debugging purposes.
	-https://github.com/barryvdh/laravel-debugbar
-PHP Imgur API Client:  Used to upload images to Imgur for hosting from Web App.
	-https://github.com/Adyg/php-imgur-api-client/tree/master
-Imgur API: Needed an account with imgur to be able to upload images API client
	-https://api.imgur.com/
-Google Geocoding API: Used to get lat/long coordinates from Zip Codes
	-https://developers.google.com/maps/documentation/geocoding/  
-Distance Formula: Used to calculate distances in SearchController.php
	-http://www.techrecite.com/distance-formula-in-php-calculate-distance-between-two-points-programmatically/
-Reddit:  I asked users on Reddit for their bike builds in order to seed my database. Users provided me with profiles from http://www.pedalroom.com.  More details in PartsController.php.
