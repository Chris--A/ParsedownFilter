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
			
				$url = $el[ 'attributes' ][ 'href' ];
				
				//If there is no protocol handler, and the link is not an open protocol address,
				//return as nothing to do.
				if( strpos( $url, '://' ) === false ){
				
					if( ( $url[ 0 ] == '/' ) && ( $url[ 1 ] != '/' ) ){
					
						return;
					}
				}					
			
				if( strpos( $url, $_SERVER["SERVER_NAME"] ) === false ){
				
					$el[ 'attributes' ][ 'rel' ] = 'nofollow';
					$el[ 'attributes' ][ 'target' ] = '_blank';
				}
				break;
				
			//
			case 'img':
			
				if( isset( $el[ 'attributes' ][ 'src' ] ) ){
				
				
				}
				break;
		}
	}
?>