<?php
session_start();
#class definitions
class RouteListItem
{
    public string $page, $name;
    public array $routes;
    public bool $hide_from_menu;

    function __construct($page, $routes, $name, $hide_from_menu = False)
    {
        $this->page = $page;
        $this->routes = $routes;
        $this->name = $name;
        $this->hide_from_menu = $hide_from_menu;
    }
}

#init
$logDir = '/logs/';
$route = explode("?", $_SERVER['REQUEST_URI'])[0] ?? '/';
$hx_request = isset($_SERVER['HTTP_HX_REQUEST']) && $_SERVER['HTTP_HX_REQUEST'] == 'true';
$dark_mode = isset($_GET['dark_mode']) && $_GET['dark_mode'];
$head = "<head/>";
$pages_folder = "/pages";
$languages = ["nl", "en"];
$default_language = "nl";
$language = $default_language;
$page_subdir = "";

if (isset($_GET['language'])) {
    $_SESSION['language'] = $_GET['language'];
}

if (isset($_SESSION['language'])) {
    $language = $_SESSION['language'];
    if ($language != $default_language && in_array($language, $languages)) {
        $page_subdir = "/" . $language;
    }
}

register_shutdown_function(function () {
    //reading these from global here allows access in _layout.php if needed
    global $content, $hx_request, $dark_mode, $head, $body, $route, $route_list, $language;
    header('Content-type: text/html; charset=utf-8');

    # pass through HTML view for HTMX requests, otherwise build new page using the layout page.
    if ($hx_request) {
        print($content);
    } else {
        require __DIR__ . '/_layout.php';
    }
});

require 'route_list.php';

#get page into output buffer and write output buffer to variable
ob_start();
$not_found = true;
foreach ($route_list as $key => $value) {
    if (in_array($route, $value->routes)) {
        require __DIR__ . $pages_folder . $page_subdir . '/' . $value->page;
        $not_found = False;
    }
}

if ($not_found) {
    http_response_code(404);
    require __DIR__ . $pages_folder . $page_subdir . '/404.html';
}

$content = ob_get_clean();

# fix header if not just passing through the HTML page
if (!$hx_request) {
    $head_start = strpos($content, '<head');
    $head = "";
    $head_end = 0;
    if (!$head_start === false) {
        $head_end = strpos($content, "</head>") + 7;
        $head = substr($content, $head_start, $head_end);
        //For simplicity assume that the entire contents of the header needs to be added to the layout header
        $head = str_replace("</head>", "", str_replace('<head hx-head="merge">', "", $head));
    }
    $body = substr($content, $head_end);
}
