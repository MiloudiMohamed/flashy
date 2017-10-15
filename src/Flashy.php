<?php

namespace Devmi\Flashy;

use Devmi\Flashy\Storage\Session;

class Flashy
{

    protected $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function push($message, $title = null, $type = 'success')
    {
        $this->session->push([
            'flashy.message' => $message,
            'flashy.type' => $type,
            'flashy.title' => $title,
        ]);
    }

    public function get($array = false)
    {
        return [
            'message' => $this->message(),
            'type' => $this->type(),
            'options' => $this->options($array),
        ];
    }

    public function filled()
    {
        return $this->message();
    }

    public function message()
    {
        return $this->session->get('flashy.message');
    }

    public function type()
    {
        return $this->session->get('flashy.type');
    }

    public function title()
    {
        return $this->session->get('flashy.title');
    }

}

