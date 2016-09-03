<?php

/**
* nDebugger
* - backtrace
* @author   Nico Hemkes
* @version  1.0.2
* @link 	https://github.com/turbopixel/nDebugger
*/
class nDebugger{

	/**
	 * show backtrace path
	 * @param bool $hideSelf Hide nDebugger::trace element
	 * @return echo Backtrace
	 */
	public static function trace( $hideSelf = false ){

		$backtrace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 20);

		if( $hideSelf == true )
			array_shift( $backtrace );

		// output div
    	$output = '';

    	$output .= self::getStyle();

		$output .= '<div class="nDebugger" >';
		$output .= '<div class="nTitle" >nDebugger::backtrace()</div>';

		// backtrace loop
	    foreach ($backtrace as $k => $v) {

	        if ($k < $ignore) continue;

	        array_walk($v['args'], function (&$item, $key) {

	        	if( !empty($item) ){
		            switch( gettype($item) ){
		            	case 'string': $arg .= 'string'; break;
		            	case 'integer': $arg .= 'int'; break;
		            	case 'double': $arg .= 'double'; break;
		            	case 'boolean': $arg .= 'bool'; break;
		            	case 'object': $arg .= 'object'; break;
		            	case 'array': $arg .= ''; break;
		            	case 'NULL': $arg .= 'NULL'; break;
		            	default: $arg .= '';
		            }

		            $arg .= ' ' . var_export( $item, 1);
		            $item = $arg;
	        	}else{
	        		$item .= 'NULL';
	        	}

	        });

	        // backtrace view
	        $output .= '<div class="nLineSub" >';
	        $output .= '#' . ($k - $ignore) . ' ' . $v['file'] . ' in line ' . $v['line'] . ':';
	        $output .= "</div>";
	        $output .= '<div class="nLine" >';
	        $output .= (isset($v['class']) ? '<strong>class</strong> ' . $v['class'] . $v['type'] : '<strong>function</strong> ');
	        $output .= $v['function'];
	        $output .= '<em>( ' . implode(', ', $v['args']) . ' )</em>';
	    	$output .= '</div><hr style="height:0; border: 1px solid #eee;" >';
	    }

	    $output .= '</div>';

	    echo $output;

	}

	public static function pre(){
    	$args = func_get_args();

    	$output = '';

    	$output .= self::getStyle();

		// output div
		$output .= '<div class="nDebugger" >';
		$output.= '<div class="nTitle" >';

    	$output .= 'nDebugger::pre() ';
    	$output .= '</div>';

	    $output .= '<div class="nLineSub" >';
    	$output .= debug_backtrace()[0]['file'] . ':' . debug_backtrace()[0]['line'];
        $output .= "</div>";
		
		$output .= self::preCode($args);

        $output .= "</div>";

        echo $output;

	}

	private function preCode($args, $recursive = false){

		foreach ($args as $arg){

	        $output .= '<div class="nLine" >';

	        if( is_array($arg) ){
	        	$output .= 'array [';
	        	foreach( $arg AS $test => $value ){


	        		if( is_array($value) ){
						$var = self::preCode($value);
					}else{
						
						ob_start();
						var_dump($value);
						$var = ob_get_clean();

					}

	        		$output .= "<br>&nbsp;&nbsp;" . $test . ' => <em>' . $var . '</em>';

	        	}
	        	$output .= '<br/>]';

	        } elseif( is_bool($arg) ) {

	        		if( $arg === true )
	        			$var = 'true';
	        		else 
	        			$var = 'false';

					$output .= '(' . gettype($arg) . ') ' . $var;

	        } elseif( is_object($arg) ) {

					$output .= '(' . gettype($arg) . ') ' . print_r($arg, 1);

	        } elseif( is_null($arg) ) {

					$output .= 'NULL';

	        } elseif( is_string($arg) && is_array(json_decode($arg, true)) && (json_last_error() == JSON_ERROR_NONE) ) {

					$output .= '(json) ' . self::preCode( json_decode($arg) );

	        } else {

        		if( is_object( $arg ) ){
					
        		}else{

    				$output .= '(' . gettype($arg) . ') ' . htmlspecialchars($arg);
        			
        		}

	        }
	        
	        
	        $output .= "</div>";

		}

		return $output;


	}


	private function getStyle(){

		$css =
			'
				.nDebugger{
					border: 1px solid #ddd;
					display: block;
					font: 13px/100% sans-serif;
				}

				.nDebugger .nTitle{
					display: block;
					padding: 10px 8px;
					color: #fff;
					font-weight: bold;
					letter-spacing: 1px;
					background: #455270
				}

				.nDebugger .nLine{
					display: block; 
					line-height: 18px;
					padding: 8px;
					border-bottom: 1px solid #eee;
				}
				.nDebugger .nLineSub{
					display: block; 
					font-size: 11px;
					line-height: 16px;
					padding: 4px 8px;
				}
				';

			// minify css
			$css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
	    	$css = str_replace( array("\r\n", "\r", "\n", "\t"), '', $css );
	    	
	    	$css = "<style>{$css}</style>";

			return $css;

	}

}