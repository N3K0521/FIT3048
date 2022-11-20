<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GraphapiTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GraphapiTable Test Case
 */
class GraphapiTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\GraphapiTable
     */
    protected $Graphapi;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Graphapi',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Graphapi') ? [] : ['className' => GraphapiTable::class];
        $this->Graphapi = $this->getTableLocator()->get('Graphapi', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Graphapi);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\GraphapiTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
