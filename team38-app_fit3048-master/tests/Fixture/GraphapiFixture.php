<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * GraphapiFixture
 */
class GraphapiFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'graphapi';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'tenant_id' => 'Lorem ipsum dolor sit amet',
                'client_id' => 'Lorem ipsum dolor sit amet',
                'client_secret' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
