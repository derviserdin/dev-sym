<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;

class MessageGenerator
{
    /**
     * @var NameGenerator
     */
    private $nameGenerator;

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var string
     */
    private $adminEmail;


    public function __construct(NameGenerator $nameGenerator, RequestStack $requestStack,$adminEmail)
    {
        $this->nameGenerator = $nameGenerator;
        $this->requestStack = $requestStack;
        $this->adminEmail=$adminEmail;
    }

    public function helloMessage()
    {
        $name=$this->requestStack->getCurrentRequest()->get(key:'name');

        /**
         * Eğer isim boş gelirse random isim yarat
         */
        if (empty($name)){
            $name=$this->nameGenerator->randomName();
        }

        $message = 'Hello ' . $name. '! '.$this->adminEmail;
        return $message;
    }
}