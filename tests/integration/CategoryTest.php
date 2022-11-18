<?php
namespace App\Tests\Integration;

use App\Domain\UseCase\CategoryIsNotExistException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CategoryTest extends WebTestCase
{   
    /** @test */
    public function i_send_category_id_then_it_returns_category(): void
    {
        /** @var KernelBrowser */
        $client = static::createClient();

        $client->request('GET', '/categories/1');

        $this->assertResponseIsSuccessful();
        
        $contentResponse = json_decode($client->getResponse()->getContent(), true);
        
        $expected = ['id' => 1, 'name' => 'bio'];
        self::assertEquals($expected, $contentResponse);
        
    }

    /** @test */
    public function i_send_unknown_category_id_then_it_throws_an_exception(): void
    {
        /** @var KernelBrowser */
        $client = static::createClient();

        $client->request('GET', '/categories/765');

        $this->assertResponseStatusCodeSame(Response::HTTP_NOT_FOUND);

        $contentResponse = json_decode($client->getResponse()->getContent(), true);

        $expected = [
            'error' => [
                'code' => CategoryIsNotExistException::CODE_CATEGORY_NOT_FOUND,
                'message' => "Category is not found with id 765"
            ]
            ];
        self::assertEquals($expected, $contentResponse);

    }

    /** @test */
    public function it_returns_all_categories(): void
    {
        /** @var KernelBrowser */
        $client = static::createClient();

        $client->request('GET', '/categories');

        $this->assertResponseIsSuccessful();
        
        $contentResponse = json_decode($client->getResponse()->getContent(), true);
        
        $expected = [
            ['id' => 1, 'name' => 'bio']
        ];
        self::assertEquals($expected, $contentResponse);
    }
}
