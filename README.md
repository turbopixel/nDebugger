# nDebugger

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
```

**Result**

```
nDebugger::backtrace()
#0 /var/www/demopage/public/nDebugger/test.php in line 13:
function testFunction( string 'my test string' )
```  

#### Example 2

```
function testFunctionArray( $arr ){
	nDebugger::trace();
	return implode( ', ', $arr );
}
```

**Result**

```
nDebugger::backtrace()

#0 /var/www/demopage/public/nDebugger/test.php in line 13:
function testFunctionArray( array ( 0 => 'test', 1 => 'debug', 2 => 'class', ) )
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
```

**Result**

```
nDebugger::backtrace()

#0 /var/www/demopage/public/nDebugger/test.php in line 8:
function testFunctionArray( array ( 0 => 'test', 1 => 'debug', 2 => 'class', ) )

#1 /var/www/demopage/public/nDebugger/test.php in line 21:
function testFunction( array ( 0 => 'test', 1 => 'debug', 2 => 'class', ) )
```
