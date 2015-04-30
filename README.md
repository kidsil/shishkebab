Requirements
--------

* MongoDB - I chose MongoDB because it tends to be faster on high insertion rates, also the data format seems to be 
Make sure to install PHP's Mongo drive too via `sudo pecl install mongo` + add `extension=mongo.so` to php.ini (Vagrant would be helpful here, but would take waay too much time to configure).
Check out the config.php for db related configuration.

Structure
--------
* css/ js/ - static files (someday they'll all go to a CDN)
* db/ - db related things (duh)
	* config.php - host/user/pass.. db configuration info
	* db.php - building the $db global itself
* README.md - this file
* init_db.php (optional) - add some dummy data, should be called directly (localhost.../init.php)
* message.php - this is the endpoint for inserting data to the DB
make sure the JSON data is sent inside the `data` variable, I'm assuming the JSON data is valid for performance's sake *(since it's being sent from CurrencyFair, I know it's a trusted source ;) )*
* controllers/ views/ - super simple (and not really with a routing option as of yet) implementation of the VC part of an MVC.
* index.php - Message Frontend - sortable paginated table + highcharts graphs (some info about stuff...)




Extra Notes
--------
* I would've gladly done this entire thing on MeteorJS (would've been the PERFECT tool, especially for live graphs), but the PDF with the instructions stated that only Java/PHP/Ruby/Python are in production (=no Node).
* message.php Tested with PHP miniserver, making 1000 cURL calls:
```
$ time curl 'http://localhost:8083/message.php?[1-1000]' -H 'Origin: http://localhost:8083' --data 'data=%7B%22userId%22%3A+%22134256%22%2C+%22currencyFrom%22%3A+%22EUR%22%2C+%22currencyTo%22%3A+%22GBP%22%2C+%22amountSell%22%3A+1000%2C+%22amountBuy%22%3A+747.10%2C+%22rate%22%3A+0.7471%2C+%22timePlaced%22+%3A+%2224%C2%ADJAN%C2%AD15+10%3A27%3A44%22%2C+%22originatingCountry%22+%3A+%22FR%22%7D' --compressed

...

[1000/1000]: http://localhost:8083/message.php?1000 --> <stdout>
{"status":"success"}--_curl_--http://localhost:8083/message.php?1000
{"status":"success"}
real    0m0.987s
user    0m0.084s
sys     0m0.224s
```
Seems pretty friggin' quick.
![Meteoro Info](https://raw.githubusercontent.com/kidsil/shishkebab/master/screenshot.png)