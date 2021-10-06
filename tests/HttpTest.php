<?php

namespace Lioneagle\LioneaglePaginator\Tests;

/**
 * @internal
 * @coversNothing
 */
class HttpTest extends TestCase
{
    /**
     * @test
     */
    public function the_page_size_parameter_is_parsed()
    {
        $response = $this->get('/models?page[size]=2');

        $response->assertJsonFragment(['per_page' => 2]);
    }

    /**
     * @test
     */
    public function the_page_size_default_is_parsed()
    {
        $response = $this->get('/models');

        $response->assertJsonFragment(['per_page' => config('lioneagle-paginator.page_size.default')]);
    }

    /**
     * @test
     */
    public function the_page_number_parameter_is_parsed()
    {
        $response = $this->get('/models?page[number]=2');

        $response->assertJsonFragment(['current_page' => 2]);
    }

    /**
     * @test
     */
    public function the_page_number_default_is_parsed()
    {
        $response = $this->get('/models');

        $response->assertJsonFragment(['current_page' => config('lioneagle-paginator.page_number.default')]);
    }

    /**
     * @test
     */
    public function the_page_size_and_page_number_work_together()
    {
        $response = $this->get('/models?page[size]=25&page[number]=2');

        $response->assertJsonFragment(['per_page' => 25]);
        $response->assertJsonFragment(['current_page' => 2]);
    }

    /**
     * @test
     */
    public function a_customised_page_number_parameter_will_be_parsed()
    {
        $customPageNumberParam = 'custom_param';

        config(['lioneagle-paginator.page_number.url_parameter' => $customPageNumberParam]);

        $response = $this->get("/models?page[{$customPageNumberParam}]=2");

        $response->assertJsonFragment(['current_page' => 2]);
    }

    /**
     * @test
     */
    public function a_customised_page_size_parameter_will_be_parsed()
    {
        $customPageSizeParam = 'custom_param';

        config(['lioneagle-paginator.page_size.url_parameter' => $customPageSizeParam]);

        $response = $this->get("/models?page[{$customPageSizeParam}]=10");

        $response->assertJsonFragment(['per_page' => 10]);
    }

    /**
     * @test
     */
    public function it_can_return_all_results()
    {
        $response = $this->get('/models?page[size]=-1');

        $response->assertJsonCount(Model::count());
        $response->assertJsonMissing(['per_page']);
    }

    /**
     * @test
     */
    public function a_customised_all_results_param_will_be_parsed()
    {
        $customParam = '*';

        config(['lioneagle-paginator.page_size.all_results' => $customParam]);

        $response = $this->get('/models?page[size]=*');

        $response->assertJsonCount(Model::count());
        $response->assertJsonMissing(['per_page']);
    }
}
