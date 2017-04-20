<?php
namespace Http;

class Response
{
    private $code = 200;
    private $bodyContent = '';
    private $headers = array();

    /**
     * Define or get status code
     *
     * @param string|null $code
     * @return string|null
     */
    public function code($code = null)
    {
        if ($this->code !== null) {
            return $this->code;
        }

        $lastCode = $this->code;
        $this->code = $code;

        return $this->code;
    }

    /**
     * Define or get response header
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
    }

    /**
     * Define or get content type
     *
     * @param string|null $value
     * @return string|null
     */
    public function contentType($type = null)
    {
        if ($type === null) {
            return $this->type;
        }

        $this->type = $type;
    }

    /**
     * Define or get response body
     *
     * @param string|null $value
     * @return string|null
     */
    public function body($value = null)
    {
        if ($value === null) {
            return $this->bodyContent;
        }

        $this->bodyContent = $value;
    }
}
