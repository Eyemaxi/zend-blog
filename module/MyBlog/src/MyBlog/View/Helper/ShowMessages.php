<?php

namespace MyBlog\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Helper\FlashMessenger;

class ShowMessages
{
    public function __invoke()
    {
        $messenger = new FlashMessenger();
        $errorMessages = $messenger->getErrorMessages();
        $messages = $messenger->getMessages();
        $result = '';
        if (count($errorMessages)) {
            $result .= '<ul class="error">';
            foreach ($errorMessages as $message) {
                $result .= '<li>' . $message . '</li>';
            }
            $result .= '</ul>';
        }

        if (count($messages)) {
            $result .= '<ul>';
            foreach ($messages as $message) {
                $result .= '<li>' . $message . '</li>';
            }
            $result .= '</ul>';
        }

        return $result;
    }
}