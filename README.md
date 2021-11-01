<div id="top"></div>
<br />
<div align="center">

<h3 align="center">Pub/Sub</h3>

  <p align="center">
    This is an implementation of a simple pub/sub server written with PHP via the Lumen micro framework. The project consists of 
    a PHP server that manages and publishes to topics and a simple express client that is a subscriber of a topic
    <br />
  </p>
</div>

<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#endpoints">Endpoints</a></li>
  </ol>
</details>

<!-- ABOUT THE PROJECT -->

## About The Project

This project was developed as a technical take home assignment for Pangaea

<p align="right">(<a href="#top">back to top</a>)</p>

### Built With

- [Lumen](https://laravel.com)
- [Express JS](https://expressjs.com)

<!-- GETTING STARTED -->

### Prerequisites

This project requires the following

- php >= 7.4
  ```sh
  apt-get install php7.4
  ```
- composer
  ```sh
  curl -sS https://getcomposer.org/installer -o composer-setup.php
  ```

### Installation

1. Clone the repo
   ```sh
   git clone https://github.com/mr-tackie/pubsub.git
   ```
2. Copy `.env.example` to `.env` and in the `server` folder and update the following entries
   ```sh
   DB_HOST=
   DB_PORT=
   DB_DATABASE=
   DB_USERNAME=
   DB_PASSWORD=
   ```
3. Run the start_server.sh script. This should start the server on `localhost:3000` and the client on `localhost:9000`
   ```sh
   bash start_server.sh;
   ```

<p align="right">(<a href="#top">back to top</a>)</p>

<!-- USAGE EXAMPLES -->

## Usage

Once everything is up and running, open a new terminal and run send_requests.sh. You should notice that the node server should log message bodies from subscribed 
topics. 


<p align="right">(<a href="#top">back to top</a>)</p>


## Endpoints

1. `POST localhost:3000/subscribe/{topic}` This endpoint receives a `url` key 
2. `POST localhost:3000/publish/{topic}` This endpoint receives any json data at all and posts to subscribers