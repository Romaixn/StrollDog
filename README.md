<div align="center">

  <h1>StrollDog</h1>
  
  <p>
    Organizing walks with your dog has never been easier
  </p>
  
  
<!-- Badges -->
<p>
  <a href="https://github.com/Romaixn/StrollDog/graphs/contributors">
    <img src="https://img.shields.io/github/contributors/Romaixn/StrollDog" alt="contributors" />
  </a>
  <a href="">
    <img src="https://img.shields.io/github/last-commit/Romaixn/StrollDog" alt="last update" />
  </a>
  <a href="https://github.com/Romaixn/StrollDog/network/members">
    <img src="https://img.shields.io/github/forks/Romaixn/StrollDog" alt="forks" />
  </a>
  <a href="https://github.com/Romaixn/StrollDog/stargazers">
    <img src="https://img.shields.io/github/stars/Romaixn/StrollDog" alt="stars" />
  </a>
  <a href="https://github.com/Romaixn/StrollDog/issues/">
    <img src="https://img.shields.io/github/issues/Romaixn/StrollDog" alt="open issues" />
  </a>
  <a href="https://github.com/Romaixn/StrollDog/blob/master/LICENSE">
    <img src="https://img.shields.io/github/license/Romaixn/StrollDog.svg" alt="license" />
  </a>
</p>
   
<h4>
    <a href="#">View Demo</a>
  <span> · </span>
    <a href="https://github.com/Romaixn/StrollDog/issues/">Report Bug</a>
  <span> · </span>
    <a href="https://github.com/Romaixn/StrollDog/issues/">Request Feature</a>
  </h4>
</div>

<br />

<!-- Table of Contents -->
# :notebook_with_decorative_cover: Table of Contents

- [About the Project](#star2-about-the-project)
  * [Tech Stack](#space_invader-tech-stack)
- [Getting Started](#toolbox-getting-started)
  * [Prerequisites](#bangbang-prerequisites)
  * [Installation](#gear-installation)
  * [Running Tests](#test_tube-running-tests)
  * [Run Locally](#running-run-locally)
  * [Deployment](#triangular_flag_on_post-deployment)
- [Contributing](#wave-contributing)
- [License](#warning-license)
- [Contact](#handshake-contact)
- [Acknowledgements](#gem-acknowledgements)

  

<!-- About the Project -->
## :star2: About the Project

<!-- TechStack -->
### :space_invader: Tech Stack

<details>
  <summary>Client</summary>
  <ul>
    <li><a href="https://vuejs.org/">Vue.js</a></li>
    <li><a href="https://tailwindcss.com/">TailwindCSS</a></li>
  </ul>
</details>

<details>
  <summary>Server</summary>
  <ul>
    <li><a href="https://symfony.com/">Symfony</a></li>
  </ul>
</details>

<details>
<summary>Database</summary>
  <ul>
    <li><a href="https://www.postgresql.org/">PostgreSQL</a></li>
  </ul>
</details>

<details>
<summary>DevOps</summary>
  <ul>
    <li><a href="https://www.docker.com/">Docker</a></li>
  </ul>
</details>

<!-- Getting Started -->
## 	:toolbox: Getting Started

<!-- Prerequisites -->
### :bangbang: Prerequisites

This project uses Docker, if not already done, install Docker Compose.

<!-- Installation -->
### :gear: Installation

Install my-project with Docker and Make

```bash
make start
```

or with only Docker

```bash
docker-compose build --pull --no-cache
docker-compose up
```

Populate Elasticsearch
```bash
make populate
```
   
<!-- Running Tests -->
### :test_tube: Running Tests

To run tests, run the following command

```bash
make test
```

<!-- Run Locally -->
### :running: Run Locally

Clone the project

```bash
git clone https://github.com/Romaixn/StrollDog.git
```

Go to the project directory

```bash
cd StrollDog
```

Install dependencies and launch project

```bash
make start
```

Project available at [https://localhost](https://localhost)

<!-- Deployment -->
### :triangular_flag_on_post: Deployment

To deploy this project run

```bash
SERVER_NAME=your-domain-name.example.com \
APP_SECRET=ChangeMe \
CADDY_MERCURE_JWT_SECRET=ChangeMe \
docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d
```

<!-- Contributing -->
## :wave: Contributing

<a href="https://github.com/Romaixn/StrollDog/graphs/contributors">
  <img src="https://contrib.rocks/image?repo=Romaixn/StrollDog" />
</a>


Contributions are always welcome!

<!-- License -->
## :warning: License

Distributed under the MPL-2.0 license. See LICENSE for more information.


<!-- Contact -->
## :handshake: Contact

Romain HERAULT - [@romaixn](https://twitter.com/romaixn) - romain@rherault.fr

Project Link: [https://github.com/Romaixn/StrollDog](https://github.com/Romaixn/StrollDog)


<!-- Acknowledgments -->
## :gem: Acknowledgements

Use this section to mention useful resources and libraries that you have used in your projects.

 - [Docker template](https://github.com/dunglas/symfony-docker)
 - [Inertia](https://inertiajs.com/)
