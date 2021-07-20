<?php

namespace Lioneagle\LioneaglePaginator\Tests;

/**
 * @internal
 * @coversNothing
 */
class ModelTest extends TestCase
{
    public function testThePaginatorReturnsTheCorrectNumberOfRecords()
    {
        $pageSize = config('lioneagle-paginator.page_size.default');

        $query = Model::paginator();

        $this->assertCount($pageSize, $query);
    }
}
