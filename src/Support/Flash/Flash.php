<?php

namespace Support\Flash;

use Illuminate\Contracts\Session\Session;

class Flash
{
    public const MESSAGE_KEY = 'lara_flash_message';
    public const CLASS_KEY = 'lara_flash_class';

    public function __construct(protected Session $session)
    {
    }

    public function get(): ?FlashMessage
    {
        $message = $this->session->get(self::MESSAGE_KEY);

        if ($message === null) {
            return null;
        }

        return new FlashMessage(
            $message,
            $this->session->get(self::CLASS_KEY, '')
        );
    }

    public function info(string $message)
    {
        $this->flash($message, 'info');
    }

    public function alert(string $message)
    {
        $this->flash($message, 'alert');
    }

    public function flash(string $message, $name)
    {
        $this->session->flash(self::MESSAGE_KEY, $message);
        $this->session->flash(self::CLASS_KEY, config("flash.{$name}", ''));
    }
}
