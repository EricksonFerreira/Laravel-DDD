# Book Store API

This is a RESTful API for a book store. It's built with Laravel and uses Laravel Sanctum for authentication. The architecture of the project is based on Domain-Driven Design (DDD) principles.

## Architecture

The project is structured into several layers following the DDD approach:

- `Entities`: This is where the core business logic resides. It contains the essential business rules and business logic.

- `Repositories`: This layer is responsible for data access logic. It communicates with the database and performs CRUD operations.

- `Services`: This layer acts as a bridge between the controllers and repositories. It contains business logic that doesn't belong in the entities or repositories.

- `Controllers`: This layer handles HTTP requests and responses. It uses services to perform operations and returns responses.

## Endpoints

### Auth

- `POST /login`: Authenticate a user and get an access token.
- `POST /logout`: Log out an authenticated user.

### Books

- `GET /books`: Get a list of all books. Requires authentication.
- `POST /books`: Add a new book. Requires authentication.
- `PUT /books/{isbn}`: Update a book with the given ISBN. Requires authentication.
- `DELETE /books/{isbn}`: Delete a book with the given ISBN. Requires authentication.

### Stores

- `GET /stores`: Get a list of all stores. Requires authentication.
- `POST /stores`: Add a new store. Requires authentication.
- `PUT /stores/{id}`: Update a store with the given ID. Requires authentication.
- `DELETE /stores/{id}`: Delete a store with the given ID. Requires authentication.

### Store Books

- `POST /stores/{store_id}/books/{isbn}`: Add a book to a store. Requires authentication.
- `DELETE /stores/{store_id}/books/{isbn}`: Remove a book from a store. Requires authentication.

## Setup

1. Clone the repository.
2. Run `composer install` to install the dependencies.
3. Copy `.env.example` to `.env` and fill in your database and other configuration.
4. Run `php artisan migrate` to run the database migrations.
5. Run `php artisan serve` to start the server.

## Testing

Use a REST client like Insomnia or Postman to test the API. For routes that require authentication, remember to include the `Authorization` header with the value `Bearer your-token-here`.

We have provided an Insomnia file to make testing easier. You can import this file into Insomnia to get a pre-configured set of requests for the API.

1. Download the [Insomnia file](public/uploads/Insomnia.json).
2. Open Insomnia.
3. Go to `File > Import Data > From File`, and select the downloaded file.

Now you should see the pre-configured requests in Insomnia, and you can start testing the API.
