# ProjectVal
[![PHP](https://img.shields.io/badge/PHP-8.2-blue.svg)](http://php.net)
[![Nette](https://img.shields.io/badge/nette-3.1-blue.svg)](https://nette.org/)
[![composer](https://img.shields.io/badge/composer-latest-green.svg)](https://getcomposer.org/)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](https://opensource.org/licenses/MIT)

ProjectVal is a web-based application that helps businesses estimate the potential value of a project before they invest time and resources into it. With ProjectVal, you can calculate the costs, benefits and return on investment of your projects with ease.

## Technologies
ProjectVal is built using the following technologies:
- Nette 3: A full-stack framework for PHP, providing an elegant and efficient way to build web applications.
- PHP 8.2: The latest version of PHP, providing improved performance and new features.
- Bootstrap 5: A popular front-end framework for creating responsive and mobile-friendly websites.
- Doctrine 2: An Object-Relational Mapper (ORM) for PHP that simplifies working with databases.

## Getting started
To run ProjectVal on your local environment, you will need to have Docker and Docker Compose installed.

1. Clone the repository: git clone https://github.com/rdurica/project_val.git
2. Build the Docker image: <code>docker-compose build</code>
3. Run the Docker container: <code>docker-compose up -d</code>
4. Download dependencies using composer. Composer installed in docker container from src folder: <code>composer install</code>
5. Move <code>src/config/database.example.neon</code> to <code>src/config/database.neon</code> and update database credentials 
6. Run database migrations (from container): <code>php src/bin/console m:m</code>
7. Access the application in your browser at http://localhost:8000

## Deployment
ProjectVal is currently being developed for training and showcase purposes. The final application will be deployed on my Kubernetes cluster, which is an open-source container orchestration system for automating the deployment, scaling, and management of containerized applications.
Kubernetes provides many benefits for application deployment, such as:

- High availability: By running multiple replicas of the application, Kubernetes ensures that the application is always available, even if one of the replicas goes down.
- Scalability: Kubernetes makes it easy to scale the application up or down as needed, by adding or removing replicas.
- Easy management: Kubernetes provides a single control plane for managing the entire application, including updates, rollbacks, and monitoring.

## Contributing
If you would like to contribute to this project, please fork the repository and create a pull request. We welcome all contributions, including bug fixes, new features, and documentation improvements.

## License
This project is licensed under the terms of the MIT license.