<?php

namespace Config\Source;

/**
 * An interface for processing config files
 */
interface ConfigFile {

    public function read($filepath);

}
