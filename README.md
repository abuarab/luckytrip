<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Prerequisites

- [Docker](https://www.docker.com/get-started)

## Getting Started

1. **Clone this repository:**

   ```bash
   git clone https://github.com/your-username/luckytrip.git
2. **Create a .env file:**

   ```bash
   cp .env.example .env
   docker-compose build
   docker-compose up
   
   -------using makefile------
   
   make up
   make composer-update
   make data

## Seeders
By using 
```make data ``` 
it will insert data to your local mysql database. However, running
```php artisan db:seed ``` also works.

## testing

Run ```vendor/bin/phpunit``` to test Apis


## Endpoints

Here are the available endpoints for interacting with the Airport API:

#### 1. Create a New Airport
- **POST /api/airports**
    - **Description**: Create a new airport with translations.
    - **cURL Example**:
```bash
  curl --location --request POST 'http://localhost:9002/api/airports' \
--header 'Accept-Language: en' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "iata_code" : "ABC",
    "latitude" : "38.8951",
    "longitude" : "-77.0364",
    "translations": [
        {
            "language_code": "en",
            "name": "test Airport", 
             "description" : "its description",
            "terms_and_conditions" : "its terms"
        },
        {
            "language_code": "fr",
            "name": "gsss de Heathrow",
            "description" : "its description",
            "terms_and_conditions" : "its terms"
        },
        {
            "language_code": "de",
            "name": "dsad Heathrow",
            "description" : "its description",
            "terms_and_conditions" : "its terms"
        }
    ]
}'
```

#### 2. Get Airports

- **GET /api/airports**
    - **Description**: Fetch airports based on name, latitude, and longitude.
    - **cURL Example**:
```bash
curl --location --request GET 'http://localhost:9002/api/airports?name=Heathrow&latitude=51.470020&longitude=-0.454295&order=asc' \
--header 'Accept-Language: en' \
--header 'Accept: application/json'
```
    - **Sample Response**:
      ```json
      [
          {
              "iata_code": "LHR",
              "latitude": 51.470020,
              "longitude": -0.454295,
              "translations": [
                  {
                      "language_code": "en",
                      "name": "Heathrow Airport",
                      "description": "The primary international airport serving London.",
                      "terms_and_conditions": "Terms and conditions for Heathrow Airport."
                  }
              }
          }
      ]
      ```

#### 3. Update an Existing Airport

- **PUT /api/airports/{airportId}**
    - **Description**: Update an existing airport by providing its ID.
    - **cURL Example**:
```bash
curl --location --request PUT 'http://localhost:9002/api/airports/4' \
--header 'Accept-Language: en' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "iata_code": "LHQ",
    "latitude": 51.470020,
    "longitude": -0.454295,
    "description": "Updated airport description",
    "terms_and_conditions": "Updated terms and conditions",
    "translations": [
        {
            "language_code": "en",
            "name": "qqqqqqq"
        },
        {
            "language_code": "fr",
            "name": "bbbbbbb"
        }
    ]
}'
```
    - **Sample Response**:
      ```json
      {
          "message": "Airport updated successfully"
      }
      ```

#### 4. Delete an Existing Airport

- **DELETE /api/airports/{airportId}**
    - **Description**: Delete an existing airport by providing its ID.
    - **cURL Example**:
```bash
curl --location --request DELETE 'http://localhost:9002/api/airports/4' \
--header 'Accept-Language: en' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "iata_code": "LHQ",
    "latitude": 51.470020,
    "longitude": -0.454295,
    "description": "Updated airport description",
    "terms_and_conditions": "Updated terms and conditions",
    "translations": [
        {
            "language_code": "en",
            "name": "Updated English Name"
        },
        {
            "language_code": "fr",
            "name": "Nom mis à jour en français"
        }
    ]
}'
```
    - **Sample Response**:
      ```json
      {
          "message": "Airport deleted successfully"
      }
      ```

#### 5. Get Airport by ID

- **GET /api/airports/{airportId}**
    - **Description**: Retrieve detailed information about an airport by providing its ID.
    - **cURL Example**:
```bash
curl --location --request GET 'http://localhost:9002/api/airports/1' \
--header 'Accept-Language: en' \
--header 'Accept: application/json'
```
    - **Sample Response**:
      ```json
      {
          "id": 1,
          "iata_code": "JFK",
          "latitude": 40.6413,
          "longitude": -73.7781,
          "translations": [
              {
                  "id": 1,
                  "airport_id": 1,
                  "language_code": "en",
                  "name": "John F. Kennedy International Airport",
                  "description": "The primary international airport serving New York City.",
                  "terms_and_conditions": "Terms and conditions for JFK Airport."
              },
              {
                  "id": 2,
                  "airport_id": 1,
                  "language_code": "fr",
                  "name": "Aéroport international John F. Kennedy",
                  "description": "Le principal aéroport international desservant New York.",
                  "terms_and_conditions": "Conditions générales pour l'aéroport JFK."
              }
          ]
      }
      ```


## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
