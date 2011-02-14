<?php
class JlmPackagerComponent {
	
	public $appDir;
	public $libDir;
	
    /** Files from these directories make it to the generated file */
	private $_mvcDirs = array(
	   'controllers'
	);
	private $_initializedViews = array();

	var $cache = true;
	var $compress = true;

	function startup() {

		$this->libDir = APP . 'plugins/jlm/jlm/lib/';
		$this->appDir = APP . 'webroot/js/jlm/';

		if (Configure::read('debug') > 0) {
			$this->cache = false;
			$this->compress = false;
		}
	}

	function l18n($string) {
		function translate($pregArray) {
			return __($pregArray[1], true);
		}
		return preg_replace_callback("#<l18n>(.+?)</l18n>#is", 'translate', $string);
	}

    function output() {
        header('Content-type: application/javascript');

        $output = $this->concate();

        if ($this->cache) {
	        $cached_copy = $this->appDir.'jlm.js';
	        if (!is_file($cached_copy)) {
				$file = fopen($cached_copy, 'a+');
				fwrite($file, $output);
				fclose($file);
	        }
        }

        echo $output;
    }

    /**
     * Concate all files into one string
     *
     * @return string
     */
    function concate() {
        $output = '';

        // Append lib files in this order
        $output .= $this->readFile($this->libDir . 'functions.js');
        $output .= $this->readFile($this->libDir . 'trimpath-template.js');
        $output .= $this->readFile($this->libDir . 'jquery.jlm.js');
		
		$output .= $this->readMvcFiles();

        if ($this->compress) {
	        App::import('Vendor', 'Jlm.jsmin');
	        $output = trim(JSMin::minify($output));
        }

        return $output;
    }

    function readMvcFiles() {
		$output = '';
        // Load other MVC dirs
        foreach ($this->_mvcDirs as $dir) {
            $appDirPath = $this->appDir . DS . $dir;
            $output .= $this->readFiles($appDirPath);
        }
		return $output;
	}

    /**
     * Returns string of .js concated files
     *
     * @param string $dirPath
     * @return string
     */
    function readFiles($dirPath) {
        if (!is_dir($dirPath)) {
            return '';
        }

        $output = '';
        $files = scandir($dirPath);
        foreach ($files as $file) {
            $ext = substr($file, -3);
            if ($ext !== '.js') {
                continue;
            }

            $path = $dirPath . DS . $file;
            $output .= $this->readFile($path);
        }
        return $output;
    }

    // /**
    //  * Returns string of templates
    //  *
    //  * @param string $viewsPath
    //  * @return string
    //  */
    // function readTemplates($viewsPath) {
    //     if (!is_dir($viewsPath)) {
    //         return '';
    //     }
    // 
    //     $viewDirs = scandir($viewsPath);
    //     $output = '';
    //     foreach ($viewDirs as $dir) {
    //         if ($dir[0] == '.') {
    //             continue;
    //         }
    // 
    //         // Init specific template array
    //         if (!in_array($dir, $this->_initializedViews)) {
    //             $output .= "jQuery.jlm.templates['$dir'] = [];\n";
    //             $this->_initializedViews[] = $dir;
    //         }
    // 
    //         $viewDirPath = $viewsPath . DS . $dir;
    //         if (!is_dir($viewDirPath)) {
    //             continue;
    //         }
    // 
    //         $files = scandir($viewDirPath);
    //         foreach ($files as $file) {
    //             $ext = substr($file, -5);
    //             if ($ext !== '.html') {
    //                 continue;
    //             }
    // 
    //             $path = $viewDirPath . DS . $file;
    //             $template = $this->readFile($path, false);
    // 
    //             // Escape some chars
    //             $template = str_replace(array("\n", "'"), array('', "\'"), $template);
    //             $templateName = str_replace('.html', '', $file);
    //             $varName = "jQuery.jlm.templates['$dir']['$templateName']";
    // 
    //             $output .= "$varName = '$template';\n";
    //         }
    //     }
    //     return $output;
    // }

    function readFile($path) {
//		CakeLog::write('debug', 'Reading JLM file: '.$path);
    	$output = "\n";
        $output .= file_get_contents($path);
        return $output;
    }

}
