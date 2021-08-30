<?php

namespace Config;

use Config\Source\PhpFile;
use Config\Source\XmlFile;
use Config\Source\YamlFile;

/**
 * A class used to process config files
 */
class Config implements \Iterator {
    private $items = [];

    private $uri_masks;
    private $index = 0;

    public function __construct(string $path) {
        $files = glob(getcwd() . $path . '*.{php,xml,jaml}', GLOB_BRACE);

        foreach($files as $filepath) {
            $ext_not_lowered = pathinfo($filepath, PATHINFO_EXTENSION);

            $ext = mb_strtolower($ext_not_lowered);

            switch ($ext) {
                case 'php':
                    $source = new PhpFile;
                    break;

                case 'xml':
                    $source = new XmlFile;
                    break;

                case 'yaml':
                    $source = new YamlFile;
                    break;
            }

            $this->items = array_merge( $this->items, $source->read($filepath) );
        }

        $this->uri_masks = array_keys($this->items);
    }

    public function getItem(string $key) {
        return $this->items[$key];
    }

    public function get(string $key) {
        return $this->uri_masks[$key];
    }

    public function current() {
        return $this->uri_masks[ $this->index ];
    }

    public function next() {
        $this->index++;
    }

    public function key() {
        return $this->index;
    }

    public function valid() {
        return isset( $this->uri_masks[ $this->key() ] );
    }

    public function rewind() {
        $this->index = 0;
    }

    public function reverse() {
        $this->uri_masks = array_reverse( $this->uri_masks );
        $this->rewind();
    }

}
