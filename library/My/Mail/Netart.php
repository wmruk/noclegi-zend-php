<?php

class My_Mail_Netart extends My_Mail
{
    protected $_smtp_server  = 'gajdaw.nazwa.pl';
    protected $_from_email   = 'mailer@gajdaw.nazwa.pl';
    protected $_from_caption = 'Administrator serwisu example.net';

    protected $_config = array(
        'ssl'      => 'ssl',
        'port'     => 465,
        'auth'     => 'login',
        'username' => 'twoje.konto@twojadomena.nazwa.pl',
        'password' => '**************'
    );

}
