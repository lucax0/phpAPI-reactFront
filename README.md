# teste-fullstack-php

###### PHP SYMFONY + DOCTRINE(sqlite drivers) ORM + REACTJS.

To run project: 

-> Mysql 8.0 server service running @ localhost:3306 ( Change password on Env File inside the project #Sqlite line) 

-> Yarn depedency manager ( To run reactJs with its depedencies)

-> PHP 7+ with composer + https://symfony.com/doc/current/setup.html

Running project: 

-> Into the main page it's needed two powershell on to run the php symphony project the other to run ReactJS.
-> First Console : `symfony serve`
-> Second Console: `yarn encore dev --watch`
-> access the localhost or 127.0.0.1 :8000 and the main page should be running fine
-> Extra step needed call a POST to the following end point so we can seed the dataBase ( Step will be changed in the future) 127.0.0.1:8000/api/dao
