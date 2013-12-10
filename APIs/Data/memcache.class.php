<?php

Class Cache {

    private $prefix, $cur_key, $cur_cache;

    public static function getInstance() {
        static $instance = null;
        if ($instance == null)
            $instance = new Cache();
        return $instance;
    }

    public function __construct() {
        if (!function_exists('memcache_connect')) {
            die('Memcache is not currently installed...');
        } else {

            $this->memcache = New Memcache;
            if (!$this->memcache->connect("localhost", "11211")) {
                die('Could not connect to the Memcache host');
            }
            $this->prefix = "aiw_";
        }
    }

    public function exists($key) {
        if ($this->memcache->get($this->prefix . $key)) {
            $this->cur_cache = $this->memcache->get($this->prefix . $key);
            $this->cur_key = $this->prefix . $key;
            return true;
        } else {
            return false;
        }
    }

    public function delete($key) {
        if ($this->memcache->get($this->prefix . $key)) {
            return $this->memcache->delete($this->prefix . $key);
        } else {
            return false;
        }
    }

    public function flush() {
        $this->memcache->flush();
    }

    public function update($key, $data, $interval) {
        $interval = (isset($interval)) ? $interval : 60 * 60 * 0.15;

        if ($this->prefix . $this->cur_key) {
            if (!empty($this->cur_cache)) {
                return $this->memcache->replace($this->cur_key, $data, MEMCACHE_COMPRESSED, $interval);
            }
        } elseif ($this->memcache->get($this->prefix . $key)) {
            return $this->memcache->replace($this->prefix . $key, $data, MEMCACHE_COMPRESSED, $interval);
        } else {
            return false;
        }
    }

    public function get($key) {
        if (($this->prefix . $key) == $this->cur_key) {
            return $this->cur_cache;
        } else {
            return $this->memcache->get($this->prefix . $key);
        }
    }

    public function set($key, $data, $interval) {
        $interval = (isset($interval)) ? $interval : 60 * 60 * 0.15;
        return $this->memcache->set($this->prefix . $key, $data, MEMCACHE_COMPRESSED, $interval);
    }

}

?>