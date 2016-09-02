<?php 

require 'lib/nDebugger.php';

function testFunction( $str ){

	if( is_array($str) )
		testFunctionArray($str);

	return $str;

}

function testFunctionArray( $arr ){

	nDebugger::trace( true );
	return implode( ', ', $arr );

}

echo testFunction( [ 'test', 'debug', 'class' ] );
