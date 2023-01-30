## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

Laravel is accessible, powerful, and provides tools required for large, robust applications.


## News Zilla

NewsZilla is a simple news blog

COPY .env.example .env

ADD database credentials in .env

RUN php artisan key:generate

Two Database Method

RUN php artisan migrate

Import existing Database from database/newszilla.sql
