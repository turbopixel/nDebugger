<?php 
require 'lib/nDebugger.php';

function myFunction($str){
    nDebugger::trace();
}

myFunction( 'this is a test string' );