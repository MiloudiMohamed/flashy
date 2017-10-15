<?php

namespace Devmi\Flashy\Storage;

use Illuminate\Session\Store;

class Session
{

    protected $session;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    public function push($key, $value = null)
    {
        if (is_array($key)) {
            return $this->pushMany($key);
        }
        $this->session->flash($key, $value);
    }

    public function pushMany(array $data)
    {
        foreach ($data as $key => $value) {
            $this->push($key, $value);
        }
    }

    public function get($key)
    {
        return $this->session->get($key);
    }
}
