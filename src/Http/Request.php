<?php
namespace Http;

class Request
{
    private $_path = '/';
    private $_method = 'GET';
    private $headers = array();

    /**
     * Define or get request header
     *
     * @param string      $name
     * @param string|null $value
     * @return string|null
     */
    public function header($name, $value = null)
    {
        if ($value === null) {
            return isset($this->headers[$name]) ? $this->headers[$name] : null;
        }

        $this->headers[$name] = $value;

        return null;
    }

    /**
     * Define or get path
     *
     * @param string|null $path
     * @return string
     */
    public function path($path = null)
    {
        if ($path === null) {
            return $this->_path ? $this->_path : null;
        }

        $this->_path = $method;
    }

    /**
     * Define or get method
     *
     * @param string $method
     * @return string
     */
    public function method($method = null)
    {
        if ($method === null) {
            return $this->_method ? $this->_method : null;
        }

        $this->_method = $method;
    }
}
