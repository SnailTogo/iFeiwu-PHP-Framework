<?php

class Session
{

    public function __construct($name = '')
    {
//         new Sessionsecur();
        ini_set('session.name', $name);
        ini_set('session.use_only_cookies', TRUE);
        if (! isset($_SESSION)) {
            ini_set('session.gc_maxlifetime', 1 * 60 * 60); // 1 hours
            session_start();
        }
    }

    public function set($key = array(), $value = '')
    {
        if (is_string($key)) {
            $key = array(
                $key => $value
            );
        }
        
        if (count($key) > 0) {
            foreach ($key as $k => $v) {
                $this->setData($k, $v);
            }
        }
    }

    public function delete($key = array())
    {
        if (is_string($key)) {
            $key = array(
                $key => ''
            );
        }
        if (count($key) > 0) {
            foreach ($key as $k => $value) {
                $this->unsetData($k);
            }
        }
    }

    private function unsetData($key)
    {
        if (isset($_SESSION[$key]))
            unset($_SESSION[$key]);
        
        return FALSE;
    }

    private function setData($key, $value)
    {
        return $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        return (isset($_SESSION[$key])) ? $_SESSION[$key] : '';
    }

    public function has($key)
    {
        return (isset($_SESSION[$key])) ? TRUE : FALSE;
    }

    public function flash($key)
    {
        if ($this->has($key)) {
            $value = $this->get($key);
            $this->unsetData($key);
            return $value;
        }
        return FALSE;
    }

    public function destroy()
    {
        session_unset();
        session_destroy();
    }
}
