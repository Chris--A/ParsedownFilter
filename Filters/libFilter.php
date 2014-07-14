<?php
	/***
		libfilter is a simple filter for the php class ParsedownFilter.
		
		Written by Christopher Andrews.
		
		Released under GPL & MIT licenses.
	
	***/

	function libFilter( &$el ){

		switch( $el[ 'name' ] ){
		
		
			/*** Any external links shall be opened in a new tab and have the nofollow attribute. ***/
			case 'a':
			
				if( strpos( $el[ 'attributes' ][ 'href' ], $_SERVER["SERVER_NAME"] ) === false ){
				
					$el[ 'attributes' ][ 'rel' ] = 'nofollow';
					$el[ 'attributes' ][ 'target' ] = '_blank';
				}
				break;
				
		}
	}
?>