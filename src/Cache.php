<?php
/*
 * "Fictitious" class, don't use
 */
class Cache
{
    private $path;

    public function setContext($middlewarecontext)
    {
        $this->context = $middlewarecontext;

        $path = sha1($this->context->response()->path());

        $this->path = 'storage/cache/~' . $path . '.tmp';
    }

    public function hasCache()
    {
        return is_file($this->path);
    }

    public function contents()
    {
        if (is_file($this->path)) {
            return file_get_contents($this->path);
        }

        throw new Exception('Invalid cache');
    }

    public function __invoke()
    {
        if ($this->hasCache() && method_exists($this->context, 'response')) {
            $this->context->response()->body($this->contents());
            return false;
        }

        return true;
    }
}
