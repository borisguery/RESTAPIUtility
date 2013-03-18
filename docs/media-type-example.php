<?php

require_once __DIR__ . '/../vendor/autoload.php';

$a = new \Zend\Http\Header\Accept();

$a->addMediaType('application/vnd.acme.user+json');

if (false !== ($match = $a->match('application/vnd.acme.user+json; version=1.8'))) {

    /** @var $match Zend\Http\Header\Accept\FieldValuePart\AcceptFieldValuePart */
    var_dump($match->getSubtype());
}

//var_dump($acceptHdr->match())
