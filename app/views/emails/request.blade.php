Hey {{ $toUser->username }}
<br>
You have someone who is interested in one of your bike parts!
<br>
{{ $fromUser->username }} is interested in your {{ $part->part_name }} {{ $part->type }}.  
If you would like to contact them about a trade, sale or anything 
else email them at {{ $fromUser->email }}.  Don't forget to update
your parts profile if you do decide to make an exchange!
<br>
Thanks,
<br>
BikeSwap