## About Project

Reloadly's Youtube Series ([Getting Started With Reloadly](https://www.youtube.com/playlist?list=PLHScUwVHI4TAV03VEtSWyiAp5IkIiBKSp)) project is an introductory project created to guide new users on how to use Reloadly's Airtime Topup API. This is a simple proof-of-concept type of project drafted in core-php and deployed via docker container.

For all beginners, we highly recommend watching the above series and creating the code on your own from scratch using this repository as a guide. This way you will be able to get through the whole system. 


## Deployment

This is an entry level php project created in core code without any frameworks or any database connections. We do not recommend using this in your production/live environments as this is just to get you an idea of how the API works and how to use it. 

In order to deploy this system, you may use any of your preferred environments for php. However, the system does come with docker enabled. So, if you have docker installed on your system you can simple run

``docker-compose up -d``

From the root directory of this repository to get the docker containers up. By default, your system will be available on port 80. We are using a simple php-apache image for this.

The system does require your Reloadly's API credentials to function. You can add those within the `/endpoints/GetToken.php` file. If you change the mode to testing, you will be required to change all endpoints to the testing environment as well.
