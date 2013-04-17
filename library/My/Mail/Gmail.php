<?php

class My_Mail_Gmail extends My_Mail
{
    protected $_smtp_server  = 'smtp.gmail.com';
    protected $_from_email   = 'someone@example.net';
    protected $_from_caption = 'Administrator serwisu example.net';

    protected $_config = array(
        'ssl'      => 'tls',
        'port'     => 587,
        'auth'     => 'login',
        'username' => 'twoje.konto@gmail.com',
        'password' => '*************'
    );
}
