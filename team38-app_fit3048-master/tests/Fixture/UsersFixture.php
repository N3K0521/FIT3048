<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
{
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
                'username' => 'Lorem ipsum dolor sit amet',
                'user_type' => 'Lorem ipsum dolor sit amet',
                'user_email' => 'Lorem ipsum dolor sit amet',
                'user_password' => 'Lorem ipsum dolor sit amet',
                'passkey' => 'Lorem ipsum dolor sit amet',
                'timeout' => 1659965437,
                'registered_timestamp' => 1659965437,
            ],
        ];
        parent::init();
    }
}
