## About Echoes-standard-template

Echoes standar template is a simple with all rules coding in team. It includes coding convention, base framework (respository), and common packages.

- Use gentelella template for admin site. [View template](https://colorlib.com/polygon/gentelella/index.html)
- Based on Prs-2 standar convention.
- Respository parttern.
- Twitter API: Use package thujohn/twitter. [Link](https://github.com/thujohn/twitter)

## Installation.
    
### Requirement

Installed vagrant (including VirtualBox) on your machine. [Link](https://howtoprogram.xyz/2016/07/23/install-vagrant-ubuntu-16-04/)

Vagrant box configruation:
    
* Ubuntu/Centos.
* \> PHP7.1.
* Nginx.
* Mysql 5.7

### Config file .ENV

```$xslt
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:uFLCbPKyepZLWfyCTDkZSsCLPNALN/jFNTr6fXI9YPk=
APP_DEBUG=true;
APP_URL=http://localhost

LOG_CHANNEL=stack

# Database connection
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

# Twitter app configruation
TWITTER_CONSUMER_KEY =
TWITTER_CONSUMER_SECRET =

# Storage folder configruation
STORAGE_CACHE       = /var/www/html/storage/framework/cache/data
STORAGE_SESSION     = /var/www/html/storage/framework/sessions
STORAGE_VIEWS       = /var/www/html/storage/framework/views
STORAGE_PATH_LOCAL  = /var/www/html/storage/app
STORAGE_PATH_PUBLIC = /var/www/html/storage/app/public
STORAGE_LOGS        = /var/www/html/storage/logs/laravel.log

# IP allows access to system
CONFIG_IP_RANGE_AA_NETWORK = 127.0.0.0/16

# Footer
COPYRIGHT_TEXT_IN_FOOTER = "Copyright (c) 2005 - _YEAR_ Allied Architects, Inc. All rights reserved.",

```

* Config database connecttion
* If you want to use twitter api, you can get the TWITTER_CONSUMER_KEY and TWITTER_CONSUMER_SECRET at [https://apps.twitter.com](https://apps.twitter.com)     
* You can change where the data is stored in the storage directory at "# Storage folder configruation".
* "CONFIG_IP_RANGE_AA_NETWORK" : Config ip range to allows to access the system.


    
