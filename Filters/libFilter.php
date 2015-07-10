<?php

	/***
		libfilter is a simple filter for the php class ParsedownFilter.

		Written by Christopher Andrews.

		Released under GPL & MIT licenses.

	***/

	function libFilter( &$el ){

		switch( $el[ 'name' ] ){

			/***
				If like me, you prefer to not write your markdown paragraphs on one line, 
				this will ensure the text isn't compacted together.
			***/

			case 'p':
			case 'span':
				if( isset($el['text']) && is_string($el['text']) ) $el['text'] = str_replace([" \n", ".\n"], [" ",". "], $el['text']);
				break;

			/***
				Link formatting helpers
				Any external links shall be opened in a new tab and have the nofollow attribute. 
			***/

			case 'a':

				$url = $el[ 'attributes' ][ 'href' ];

				/***
					If there is no protocol handler, and the link is not an open protocol address, 
					the links must be relative so we can return as there is nothing to do.
				***/

				if( strpos( $url, '://' ) === false )
					if( ( ( $url[ 0 ] == '/' ) && ( $url[ 1 ] != '/' ) ) || ( $url[ 0 ] != '/' ) ){ return; }

				if( $url[ 0 ] == '#' ) return; //ID anchor.


				if( strpos( $url, $_SERVER["SERVER_NAME"] ) === false ){
				
					$el[ 'attributes' ][ 'rel' ] = 'nofollow';
					$el[ 'attributes' ][ 'target' ] = '_blank';
				}
				break;

			/***
				Image formatting helpers.

				In the url certain values can be encoded.
				Variables x & y refer to the image width and height.
				Values can be numbers suffixed with either:
					* a percent sign '%'
						- This is percent of original image, not of ancestor elements.
					* the string 'px'
						- The desired width and height in pixels.
			***/

			case 'img':

				if( isset( $el[ 'attributes' ][ 'src' ] ) ){

					//Find formatting tags.
					parse_str( parse_url( str_replace( '&amp;', '&', $el[ 'attributes' ][ 'src' ] ), PHP_URL_QUERY ), $parseResult );

					if( is_array( $parseResult ) ){
						CheckImgAttr( $parseResult, $el[ 'attributes' ], 'x', 'width' );
						CheckImgAttr( $parseResult, $el[ 'attributes' ], 'y', 'height' );
					}
				}
				break;
		}
	}
	
	function CheckImgAttr( array &$el, array &$attr, $id, $tag ){

		if( isset( $el[ $id ] ) ){

				if( endsWith( $el[ $id ], 'px' ) ){

					//Apply attribute and remove suffix.
					$attr[ $tag ] = substr( $el[ $id ], 0, -2 ) . '';
				}//else if(  ){
				//getimagesize
				//}
		}
	}
	
	
	/*** 
		This will be left in until I'm happy with the result.
	***/
	
	function DBG( $str ){
		echo "<p>$str</p>";
	}
	
	/*** 
		These two functions sourced from: http://stackoverflow.com/a/834355 
	***/
	
	function startsWith($haystack, $needle)
	{
		 $length = strlen($needle);
		 return (substr($haystack, 0, $length) === $needle);
	}

	function endsWith($haystack, $needle)
	{
		$length = strlen($needle);
		if ($length == 0) {
			return true;
		}

		return (substr($haystack, -$length) === $needle);
	}	
?>