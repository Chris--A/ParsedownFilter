## ParsedownFilter
### An extension for Parsedown ( http://parsedown.org ).
#### Written by Christopher Andrews.

---

This class will allow you do define a callback which can intercept each html tag that is output by Parsedown.

### Instantiation of ParsedownFilter. This example will modify any external links 
to be opened in a new tab and have the `nofollow` attribute applied. 
This is handy when you cannot monitor links that people may post on your site.

A knowledge of the inner workings for Parsedown may be required, however I'll update this section soon with 
a basic instruction set for custom markdown tag filtering.
 
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