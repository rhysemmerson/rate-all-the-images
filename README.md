# Image rating app

## Installation
    
    composer install
    
Create .env file and be sure to set APP_URL correctly

The app uses a sqlite db by default so no other setup is required

then run

    php artisan migrate --seed
    
## Run testsuite

    vendor/bin/phpunit

## API
* uses session to authenticate requests
 
## Endpoints

### /ratings

GET: 

    Get the current user's ratings
    {
        "data": [
            {
                "id": <integer>,
                "image_id": <integer>
            }
        ]
    }

POST:

    Add a rating
    
    {
        "image_id": <integer>,
        "rating": <boolean>
    }
    
### /images/random

GET:

    Get a random image that the user hasn't already rated
    
    {
        "id": <integer>,
        "image_url": <string>
    }