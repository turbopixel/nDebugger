# nDebugger

nDebugger is a simple php debugging class.

* Author: Nico Hemkes ([https://hemk.es](hemk.es))
* Date: 2016-09-02
* Version: 1.0.2

#### Requirements

* PHP > 5.4

## 1. Install

Just copy the source or clone this repository( `git clone git@github.com:turbopixel/nDebugger.git` ) and include the class like `require 'lib/nDebugger.php';`

## 2. Usage

### nDebugger::trace()

#### `mixed nDebugger::trace( [ bool $hideSelf= false ] );`  
  
**Parameters**  

- $hideSelf - Ignore the last backtrace ( nDebugger::trace() )

#### Example 1

```
function myFunction($str){
    nDebugger::trace();
}

myFunction( 'this is a test string' );
```

**Result**

```
nDebugger::backtrace()
#0 /var/www/demopage/public/nDebugger/test.php in line 13:
function myFunction( string 'this is a test string' )
```  

#### Example 2

```
function testFunctionArray( $arr ){
	nDebugger::trace();
	return implode( ', ', $arr );
}

testFunctionArray( ['apple', 'banana', 'zitrone'] );
```

**Result**

```
nDebugger::backtrace()

#0 /var/www/demopage/public/nDebugger/test.php in line 13:
function testFunctionArray( array ( 0 => 'apple', 1 => 'banana', 2 => 'zitrone', ) )
```
#### Example 3

```
function testFunction( $str ){

	if( is_array($str) )
		testFunctionArray($str);

	return $str;

}

function testFunctionArray( $arr ){

	nDebugger::trace();
	return implode( ', ', $arr );

}

testFunction( [ 'foo', 'bar' ] );
```

**Result**

```
nDebugger::backtrace()

#0 /var/www/demopage/public/nDebugger/test.php in line 8:
function testFunctionArray( array ( 0 => 'foo', 1 => 'bar', ) )

#1 /var/www/demopage/public/nDebugger/test.php in line 21:
function testFunctionArray( array ( 0 => 'foo', 1 => 'bar', ) )
```

### nDebugger::pre()

You use the php functions ´print_r()´ or ´var_dump(); exit; ´ for debugging? That sucks!

#### `mixed nDebugger::pre( mixed $expression [, mixed $...] );`  

Parameters

#### Example 1:

nDebugger::pre( 'Hello World', true, array( 'apple', 'banana' ), ( 4.5*5 ), ( $a == true ) );

**Result**

```
nDebugger::pre()
/var/www/demopage/public/nDebugger/test.php:4

(string) Hello World

(boolean) true

array [
  0 => string(5) "apple" 
  1 => string(6) "banana" 
]

(double) 22.5

(boolean) false
```