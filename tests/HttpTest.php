<?php

namespace Lioneagle\LioneaglePaginator\Tests;

/**
 * @internal
 * @coversNothing
 */
class HttpTest extends TestCase
{
    public function testThePageSizeParameterIsParsed()
    {
        $response = $this->get('/models?page[size]=2');

        $response->assertJsonFragment(['per_page' => 2]);
    }

    public function testThePageSizeDefaultIsParsed()
    {
        $response = $this->get('/models');

        $response->assertJsonFragment(['per_page' => config('lioneagle-paginator.page_size.default')]);
    }

    public function testThePageNumberParameterIsParsed()
    {
        $response = $this->get('/models?page[number]=2');

        $response->assertJsonFragment(['current_page' => 2]);
    }

    public function testThePageNumberDefaultIsParsed()
    {
        $response = $this->get('/models');

        $response->assertJsonFragment(['current_page' => config('lioneagle-paginator.page_number.default')]);
    }

    public function testThePageSizeAndPageNumberWorkTogether()
    {
        $response = $this->get('/models?page[size]=25&page[number]=2');

        $response->assertJsonFragment(['per_page' => 25]);
        $response->assertJsonFragment(['current_page' => 2]);
    }

    public function testACustomisedPageNumberParameterWillBeParsed()
    {
        $customPageNumberParam = 'custom_param';

        config(['lioneagle-paginator.page_number.url_parameter' => $customPageNumberParam]);

        $response = $this->get("/models?page[{$customPageNumberParam}]=2");

        $response->assertJsonFragment(['current_page' => 2]);
    }

    public function testACustomisedPageSizeParameterWillBeParsed()
    {
        $customPageSizeParam = 'custom_param';

        config(['lioneagle-paginator.page_size.url_parameter' => $customPageSizeParam]);

        $response = $this->get("/models?page[{$customPageSizeParam}]=10");

        $response->assertJsonFragment(['per_page' => 10]);
    }
}
