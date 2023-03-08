# Final Project Installation Guide
## Directory Tree
* www/ - the website source code, all contents of this
	dir should be placed in your web directory
* readme.md - this file! Gives the gist of installation,
	and other things
## Software needed for installation
* PHP - the scripting language that the source
	uses for db communication, and dynamic stuff!
* lighttpd - a web server, others should be usable
* sqlite3 - the database, may need to enable usage
	in your php.ini file
## Installation Assuming GNU/Linux
	It should be as simple as plopping all the files stored in
www/ into your web directory, which may be something like /var/www/html,
or /srv/http/. However you may need to edit your [php.ini](/etc/php/php.ini) file,
specifically uncommenting the line that reads "extension=pdo_sqlite". As long as
your webserver is configured to execute PHP scripts correctly, everything should
be great.
## Installation Under Windows
I have no clue!
## Contact Information
E-Mail: [redacted these were the instructs I sent the professor lol]
Feel free to contact me if you need any assistance. We could set up a meeting
if assistance, or further clarification is needed.
