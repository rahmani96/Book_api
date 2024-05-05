<h1 align="center" style="">RestFul API Laravel</h1>

## About Project

Project is consiste  of a RESTful API built with the Laravel framework. The project provides CRUD operations for books.

## Execute Project
    For better results, Please follow this steps:
- **Download project and in terminal do the command : "composer install"**
- **Create database named "skaalab_API_book"**
- **Migrate all tables : "php artisan migrate"**
- **To insert some fake data use : "php artisan db:seed"**


## Detail of Endpoints 

- **Show All Books:** 
##### GET Method - /api/v1/books
Return a list of books.
- **Show Specified Book:**
##### GET Method - /api/v1/books/{book}
Return a specified book.
- **Create Book:**
##### POST Method - /api/v1/books
Return a created book.
- **Update Book:**
##### PUT Method - /api/v1/books
Returns a list of books.
- **Delete Book:**
##### DELETE Method - /api/v1/books/{book}
Returns a deleted book.
