<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContactusTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContactusTable Test Case
 */
class ContactusTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ContactusTable
     */
    protected $Contactus;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Contactus',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Contactus') ? [] : ['className' => ContactusTable::class];
        $this->Contactus = $this->getTableLocator()->get('Contactus', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Contactus);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ContactusTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
