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
	 * @param bool $hideTrace Hide nDebugger::trace element
	 * @return echo Backtrace
	 */
	public static function trace( $hideTrace = false ){

		$backtrace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 20);

		if( $hideTrace == true )
			array_shift( $backtrace );

		// output div
		$output = '<div style="border: 1px solid #ddd; display: block; font: 13px/100% sans-serif" >';
		$output.= '<div style="display: block; padding: 10px 8px; color: #fff; font-weight: bold; letter-spacing: 1px; background: #455270" >nDebugger::backtrace()</div>';

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
	        $output .= '<div style="display: block; line-height: 18px; padding: 8px;" >';
	        $output .= '#' . ($k - $ignore) . ' ' . $v['file'] . ' in line ' . $v['line'] . ':';
	        $output .= "</div>";
	        $output .= '<div style="display: block; line-height: 18px; padding: 4px; margin: 0 0 0 18px; border-left: 2px solid #eee;" >';
	        $output .= (isset($v['class']) ? '<strong>class</strong> ' . $v['class'] . $v['type'] : '<strong>function</strong> ');
	        $output .= $v['function'];
	        $output .= '<em>( ' . implode(', ', $v['args']) . ' )</em>';
	    	$output .= '</div><hr style="height:0; border: 1px solid #eee;" >';
	    }

	    $output .= '</div>';

	    echo $output;

	}

}