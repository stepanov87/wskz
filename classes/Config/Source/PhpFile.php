<?php

namespace Config\Source;

use Config\Source\ConfigFile;

/**
 * A class for processing php config files
 */
class PhpFile implements ConfigFile {

    public function read($filepath) {
        return include($filepath);
    }

}