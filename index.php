<!-- I use this file as a entry pipeline for this API. -->
<?php

// If URL path is set then separate each route into one array of strings and trim the first empty index
// Otherwise return Home Page AKA '/'
$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : '/';

if ($url == '/') {
    // If Home Page is requested
    // Import all MVC files for index page
    require_once __DIR__ . '/Models/index_model.php';
    require_once __DIR__ . '/Controllers/index_controller.php';
    require_once __DIR__ . '/Views/index_view.php';

    // Create Index Model
    $indexModel = new IndexModel();
    // Call the Index Model via its controller
    $indexController = new IndexController($indexModel);
    // Create the View based on what Model has returned
    $indexView = new IndexView($indexController);

    // Print the Home Page View
    print $indexView->index();
} else {

    // Different Page is requested

    // declare controller in a new variable
    $requestedController = $url[0];

    // declare action for the controller if it exist
    $requestedAction = isset($url[1]) ? $url[1] : '';

    // declare other params in an array in case they exist
    $requestedParams = array_slice($url, 2);

    // Check if MVC exists for the request
    $ctrlPath = __DIR__ . '/Controllers/' . $requestedController . '_controller.php';
    $mdlPath = __DIR__ . '/Models/' . $requestedController . '_model.php';
    $viewPath = __DIR__ . '/Views/' . $requestedController . '_view.php';

    if (file_exists($ctrlPath) && file_exists($mdlPath) && file_exists($viewPath)) {
        // If they exist then proceed
        // Import all corresponding MVC
        require_once __DIR__ . '/Models/' . $requestedController . '_model.php';
        require_once __DIR__ . '/Controllers/' . $requestedController . '_controller.php';
        require_once __DIR__ . '/Views/' . $requestedController . '_view.php';

        // capitlize first letter to create object instances later
        $modelName      = ucfirst($requestedController) . 'Model';
        $controllerName = ucfirst($requestedController) . 'Controller';
        $viewName       = ucfirst($requestedController) . 'View';

        // Create corresponding MVC instances
        $controllerObj  = new $controllerName(new $modelName);
        $viewObj        = new $viewName($controllerObj);


        // If there is a method - Second parameter
        if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === "DELETE" || $_SERVER['REQUEST_METHOD'] === "GET") {
            if (isset($_POST["todo"])) {
                print $controllerObj->addTodo($_POST["todo"]);
                print $viewObj->index();
            }
            if ($_SERVER['REQUEST_METHOD'] === "DELETE") {
                $controllerObj->deleteTodo($requestedAction);
            }
            if ($_SERVER['REQUEST_METHOD'] === "GET") {
                if ($requestedAction == '') {
                    print $viewObj->index();
                } else {
                    print $viewObj->showTodo($requestedAction);
                }
            }
        }
    } else {
        // No countroller was found
        header('HTTP/1.1 404 Not Found');
        die('404 - The file - ' . $ctrlPath . ' - not found');
    }
}
