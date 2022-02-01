# Custom MVC using PHP

Model View Controller

I used Apache Server provided by XAMPP Control Panel V.3.2.4 whcih uses Php Version 7.

## API routes

### routes

/todos | request method GET => response is an HTML conatining all todos

/todos/$id | request method GET => response is a HTML containing todo with id of $id

/todos | request method POST => response status 200 when success | Headers must have `{todo:<string>}`

/todos/$id | request method PUT => response status 200 when success | Headers must have `{todo:<string>,completed:<boolean>}`

/todos/$id | request method DELETE => response status 200 when success

Author: Aryan Karim

References:

1. https://lancecourse.com/howto/how-to-start-your-own-php-mvc-framework-in-4-steps
2. https://www.kodingmadesimple.com/2016/05/how-to-write-json-to-file-in-php.html
