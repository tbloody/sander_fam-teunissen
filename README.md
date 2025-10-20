This website contains a simple framework using some PHP code and HTMX to make a simple SPA with fallback to an oldschool PHP website for when the end user wants to disable JavaScript.
The intent of this framework is to be easy to use and simple enough to modify without in-depth knowledge of PHP and HTMX.

Framework files:
 - index.php
 - script/htmx-2.0.6.min.js
 - script/htmx-head-support-2.0.2.js

The framework assumes a pages folder in the same directory as the index.php. This can be overridden by changing the $pages_folder variable in the init section near the top of the file, underneath the class definition.
The pages folder should contain at least a ```404.html``` since that is used as a fallback for when a specified route can not be found.

The base for the website is assumed to be put inside a _layout.php file, which will be supplied with the following parameters:
- ```$content``` | this contains the full content of the page, including head section. Not intended to be used, but available if you need it.
- ```$hx_request``` | true if you are processing an HTMX request, should be false if you encounter it in your ```_layout.php```
- ```$dark_mode``` | indicates wheter the page is in dark mode. Can be used to add ?dark_mode=true to remember dark_mode setting without storing info about a user.
- ```$head``` | contains whatever is inside de <head> section of the page, empty string if no <head> section was found.
- ```$body``` | contains the content of the page without the <head> section, intended to be used inside your container ```<div>```. 
- ```$route``` | contains the current route in case you want to use that, can be used for breadcrumbs or simular purpose.
- ```$route_list``` | list of RouteListItem objects that each contain:
    - ```$page``` | the html file name i.e. ```home.html```
    - ```$routes``` | an array of routes that should lead to this page i.e. ```['/','/home']```
    - ```$name``` | the name the user should get to see, intended to be used to build your navigation menu.
    - ```$hide_from_menu``` | boolean to indicate whether the item should be shown in the menu. Intended to be used when rendering your navigation menu. Optional, defaults to false;

The format for the pages is assumed to be just the content you want inside the container you define in your ```_layout.php```. Alternatively you can add a ```<head>``` section containing specifics to include inside the ```<head>``` of the main page. We use the HTMX header extension for that, so custom attributes as per that plugin apply, most notably ```hx-head="merge"``` on a title, to have it properly replace the old title.
This is intended for things that differ per page, like the meta tag for keywords and description.
In your ```_layout.php``` you need to provide the tags you want HTMX to **not** swap out with an ```hx-preserve="true"``` attribute.


