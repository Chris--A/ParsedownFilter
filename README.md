## ParsedownFilter
### An extension for Parsedown ( http://parsedown.org ).
#### Written by Christopher Andrews.

---

This class will allow you do define a callback which can intercept each html tag that is output by Parsedown.

### Instantiation of ParsedownFilter. 
This example will modify any external links 
to be opened in a new tab and have the `nofollow` attribute applied. 
This is handy when you cannot monitor links that people may post on your site.

A knowledge of the inner workings for Parsedown may be required, however I'll update this section soon with 
a basic instruction set for custom markdown tag filtering.

When an element is passed to your callback, it has a few properties which can be modified to suit your application.
It is possible to add nested html elements, and also remove or modify the current element. Some helper functions for 
this will be available soon.


| Property | Description |
| :--- | :--- |
| $tag[ 'name' ] | The name of the tag.
| $tag[ 'text' ] | The text between the opening and closing tags.
| $tag[ 'attributes' ] | An array containing tag properties to be written.
 
```php

require('Parsedown.php');
require('ParsedownFilter.php');

$obj = new ParsedownFilter( 'myFilter' );
	
function myFilter( &$el ){

	switch( $el[ 'name' ] ){
		case 'a':
		
			if( strpos( $el[ 'attributes' ][ 'href' ], $_SERVER["SERVER_NAME"] ) === false ){
			
				$el[ 'attributes' ][ 'rel' ] = 'nofollow';
				$el[ 'attributes' ][ 'target' ] = '_blank';
			}
			break;
			
	}
}
```