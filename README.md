# INSAT : Social Club
This is a repository for INSAT Social Club which is a Social Media platform that allows you to connect with your friends and family, share your thoughts, ideas, and memories with others. You can also chat with your friends in real-time and stay connected with them no matter where you are.

<p align="center">
  <img src="https://i.imgur.com/K8prkdB.gif" alt="Description of your GIF">
</p>

### Tech Stack:
![Vue.js](https://img.icons8.com/color/48/000000/vue-js.png)![CSS](https://img.icons8.com/color/48/000000/css3.png) ![PHP](https://img.icons8.com/officel/48/000000/php-logo.png)  ![JavaScript](https://img.icons8.com/color/48/000000/javascript.png) ![HTML](https://img.icons8.com/color/48/000000/html-5.png) 


### Project Setup:
#### Prerequisites:
* XAMPP: Ensure you have XAMPP installed on your machine. Download and install it from the official website if you don't have it already: https://www.apachefriends.org/download.html
* Apache & MySQL Services: Make sure both Apache and MySQL services are running within XAMPP.
* Composer: Composer is required for dependency management. If not installed, follow the installation guide here: https://getcomposer.org/download/

#### Steps:

* 1) Clone the Project: Clone the project repository using Git (assuming you have Git installed).

* 2) Project Location: Move the cloned project directory to the following location within your XAMPP installation:
```
C:\xampp\htdocs\php
```
* 3) Install Dependencies: Open a terminal or command prompt and navigate to the project directory (C:\xampp\htdocs\php\Social-Media-Clone. Then, execute the following commands in sequence:

```
npm install

composer install
```

* 4) Database Setup:

The project includes a **[Database Script](src/DataBaseScript/script.sql)**.
You can import this script into your MySQL database using a tool like phpMyAdmin within XAMPP.



### To run the project:
Execute the following command
```
npm run serve
```


### Customize configuration
See [Configuration Reference](https://cli.vuejs.org/config/).
