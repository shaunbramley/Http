<?php
namespace Bramley\Http;

use Symfony\Component\DomCrawler\Form;

interface SubmitableInterface {
    /**
     * @param Symfony\Component\DomCrawler\Form $form A Symfony DomCrawler form object
     * @param array $values An array of values that will compose the submitted forms values.
     * 
     * @return Guzzle\Message\RequestInterface
     */
    public function submit(Form $form, array $values = []);
}

?>