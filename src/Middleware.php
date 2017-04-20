<?php
class Middleware
{
    private $handlers = array();
    private $classes = array();
    private $listen = array();

    /**
     * [on hold] Description
     *
     * @param string $name
     * @param string $class
     * @param bool   $global
     * @return void
     */
    public function alias($name, $class, $global = false)
    {
        $this->classes[$name] = $class;

        if ($global) {
            call_user_func(array($this, $name));
        }
    }

    /**
     * [on hold] Description
     *
     * @param string $name
     * @param array  $class
     * @return void
     */
    public function __call($name, $arguments)
    {
        if (isset($this->handlers[$name])) {
            return $this->handlers[$name];
        }

        if (empty($this->classes[$name])) {
            throw new \Exception('Invalid alias');
        }

        $classname = '\\' . ltrim($this->classes[$name]);
        $obj = new $classname;

        if (method_exists($obj, 'setContext')) {
            $obj->setContext($this);
        }

        if (method_exists($obj, '__invoke')) {
            $this->listen['invoke:' . $name] = $obj;
        }

        return $this->handlers[$name] = $obj;
    }

    /**
     * [on hold] Description
     *
     * @param callable $callback
     * @return void
     */
    public function queue($callback)
    {
        if (is_callable($callback)) {
            $this->listen[] = $callback;
        } else {
            throw new \Exception('Invalid function');
        }
    }

    /**
     * [on hold] Description
     *
     * @param \Closure $callback
     * @return void
     */
    public function dispatch(\Closure $ready)
    {
        foreach ($this->listen as $callback) {
            if (!call_user_func($callback, $this)) {
                break;
            }
        }

        $ready($this);
    }
}
