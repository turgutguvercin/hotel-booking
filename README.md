# hotel-booking
A secure web application for hotel booking
<h2>Getting Icons </h2>
Adding icons from fontawesome.com
<br/>
https://fontawesome.com/start
<br/>
Get your cdn add to header to use icons.


<h2>Security Considerations</h2>
<h3>Preventing Sql Injection </h3>
Utilizing bind variables can eliminate the need to concatenate SQL commands. This method serves as a protective measure against potential cyber threats, effectively safeguarding your code from unscrupulous users who may attempt to modify or inject extra statements.
<br/>
 https://www.php.net/manual/en/mysqli-stmt.bind-param.php
 
<h3>Sanitizing</h3> 
Sanitizing is like cleaning the user's input to remove any bad characters. Validation is like double-checking to make sure the input is in the right format and type. By sanitizing, we make sure the input is ready and safe for showing on the screen or saving in a database.
https://www.php.net/manual/en/filter.filters.sanitize.php

<h3>Password Hash and Validation<h3>
 
 Hashing is like converting your password, or any data, into a short code made of letters and/or numbers using a special coding system. This means even if a website gets hacked, the bad guys don't actually see your password. Also, makes passwords not accessible by developers/insiders.

<h2>Dummy Data </h2>
Database is already seeded with dummy data.
