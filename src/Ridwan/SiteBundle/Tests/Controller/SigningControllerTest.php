<?php

namespace Ridwan\TestBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SigningControllerTest extends WebTestCase
{
    public function testLoginPage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $this->assertTrue($crawler->filter('html:contains("Login")')->count() > 0);
    }

    public function testLogin(){
        $client = static::createClient();

        // goes to the secure page
        $crawler = $client->request('GET', '/login');

        // redirects to the login page
        //$crawler = $client->followRedirect();

        // submits the login form
        $form = $crawler->selectButton('Login')->form(array('_username' => 'sasuke', '_password' => '123456'));
        $client->submit($form);

        // redirect to the original page (but now authenticated)
        $crawler = $client->followRedirect();

        // check that the page is the right one
         //$this->assertCount(1, $crawler->filter('h1.title:contains("Let\'s Volunteer Register")'));

       $this->assertTrue($crawler->filter('html:contains("Greetings")')->count() > 0);
        // click on the secure link
        //$link = $crawler->selectLink('Hello resource secured')->link();
        //$crawler = $client->click($link);

        // check that the page is the right one
       // $this->assertCount(1, $crawler->filter('h1.title:contains("secured for Admins only!")'));
    }
}
