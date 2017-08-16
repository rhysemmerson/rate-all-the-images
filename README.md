# Image rating app

## Installation
    
    composer install

## Run

    php artisan serve

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