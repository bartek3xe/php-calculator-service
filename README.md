# Calculator Service

# Calculator Service

This project serves as a basic calculator service, allowing you to perform addition (+), subtraction (-), multiplication (*), and division (/) operations.

## Getting Started

Follow these steps to set up and run the project using Symfony, Composer, npm for frontend assets, and Docker for containerized development:

### Prerequisites

Make sure you have the following software installed on your system:

- [Docker](https://docs.docker.com/get-docker/)
- [Composer](https://getcomposer.org/download/)
- [Node.js and npm](https://nodejs.org/)

### Installation

1. Clone the repository:

```bash
git clone https://github.com/openmobi/calculator-service.git
cd calculator-service
```
2. Install PHP dependencies using Composer:

```bash
composer install
```

3. Install JavaScript dependencies using npm:

```bash
npm install
```

4. Build the frontend assets:

```bash
npm run build
```

### Running with Docker (setup-docker branch)

1. Build and start the Docker containers:

```bash
docker-compose up --build -d
``` 

2. Access the project at localhost:8080 in your web browser. If the address doesn't work, proceed to the manual Symfony server start.

### Manual Symfony Server Star

1. Run the Symfony development server:

```bash
symfony server:start
```

2. Access the project at localhost:8000 in your web browser.

---

Now, you should be able to use the Calculator Service for performing basic mathematical operations. If you face any problems or have questions, refer to the project's documentation. Happy calculating!

