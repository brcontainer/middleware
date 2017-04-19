<?php
class Middleware
{
    private $listen = array();
    private $classes = array();

    public function alias($name, $class)
    {
        $this->classes[$name] = $class;
    }

    public function __call($name, $arguments)
    {
        if (isset($this->classes[$name])) {
            $classname = $this->classes[$name];
            $obj = new $classname;

            if (method_exists($obj, 'context')) {
                $obj->context($this);
            }

            return $this->context[$name] = $obj;
        }

        throw new Exception('Invalid alias');
    }

    public function put($callback)
    {
        if (is_callable($callback)) {
            $this->listen[] = $callback;
        } else {
            throw new Exception('Invalid function');
        }
    }

    public function dispatch(\Closure $ready)
    {
        $context = array($this);

        foreach ($this->listen as $callback) {
            if (!call_user_func($callback, $this)) {
                break;
            }
        }

        $ready($this);
    }
}
