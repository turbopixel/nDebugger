# nDebugger

* Author: Nico Hemkes ([https://hemk.es](hemk.es))
* Date: 2016-09-02
* Version: 1.0.2

**Requirements**

* PHP > 5.4

**Example 1: function with string**

```
function myFunction(){
    nDebugger::trace( true );
}
```

**Result 1**

```
nDebugger::backtrace()

#0 /var/www/demopage/public/nDebugger/test.php in line 13:
function testFunction( string 'my test string' )
```

**Example 2: function with array**

```
function testFunctionArray( $arr ){
	nDebugger::trace( true );
	return implode( ', ', $arr );
}
```

**Result 2**

```
nDebugger::backtrace()

#0 /var/www/demopage/public/nDebugger/test.php in line 13:
function testFunctionArray( array ( 0 => 'test', 1 => 'debug', 2 => 'class', ) )
```
**Example 3: nested functions**

```
function testFunction( $str ){

	if( is_array($str) )
		testFunctionArray($str);

	return $str;

}

function testFunctionArray( $arr ){

	nDebugger::trace( true );
	return implode( ', ', $arr );

}
```

**Result 3**

```
nDebugger::backtrace()

#0 /var/www/demopage/public/nDebugger/test.php in line 8:
function testFunctionArray( array ( 0 => 'test', 1 => 'debug', 2 => 'class', ) )

#1 /var/www/demopage/public/nDebugger/test.php in line 21:
function testFunction( array ( 0 => 'test', 1 => 'debug', 2 => 'class', ) )
```
