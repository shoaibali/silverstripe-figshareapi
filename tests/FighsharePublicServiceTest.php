<?php
/**
 * @package figshareapi
 * @subpackage tests
 */

class FighsharePublicServiceTest extends SapphireTest {

    public function testGetResourceArticles(){
        $articles = new FigsharePublicService("articles");
        $articles->setLimit(5);
        $response = $articles->getResource();

        $this->assertJson($response);
        $this->assertCount(5, json_decode($response));

        $articles = new FigsharePublicService("articles");
        $articles->setPage(10);
        $response = $articles->getResource();
        $this->assertCount(10, json_decode($response));

        $articles->setPageSize(20);
        $response = $articles->getResource();
        $this->assertCount(20, json_decode($response));

        $articles->setOffset(0);
        $response = $articles->getResource();
        $result = json_decode($response);
        $this->assertEquals("ConflictingPaginationOptions", $result->code);

        $articles->setLimit(10);
        $response = $articles->getResource();
        $result = json_decode($response);

        $this->assertEquals("ConflictingPaginationOptions", $result->code);
    }

}
