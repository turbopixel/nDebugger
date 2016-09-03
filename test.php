<?php 
require 'lib/nDebugger.php';

// -- ::trace
function myFunction($str){
    nDebugger::trace();
}

myFunction( 'this is a test string' );

// -- ::pre
nDebugger::pre( 'Hello World', true, array( 'apple', 'banana' ), ( 4.5*5 ), ( $a == true ) );
