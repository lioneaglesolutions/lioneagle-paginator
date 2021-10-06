<?php

namespace Lioneagle\LioneaglePaginator\Tests;

/**
 * @internal
 * @coversNothing
 */
class ModelTest extends TestCase
{
    /**
     * @test
     */
    public function the_paginator_returns_the_correct_number_of_records()
    {
        $pageSize = config('lioneagle-paginator.page_size.default');

        $query = Model::paginator();

        $this->assertCount($pageSize, $query);
    }

    /**
     * @test
     */
    public function the_paginator_returns_all_records()
    {
        $query = Model::paginator(-1);

        $this->assertCount(Model::count(), $query);
    }
}
