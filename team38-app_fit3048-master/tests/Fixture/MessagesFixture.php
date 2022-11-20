<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MessagesFixture
 */
class MessagesFixture extends TestFixture
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
                'body' => 'Lorem ipsum dolor sit amet',
                'date' => 1665048002,
                'subject' => 'Lorem ipsum dolor sit amet',
                'sender' => 'Lorem ipsum dolor sit amet',
                'receiver' => 'Lorem ipsum dolor sit amet',
                'cc' => 'Lorem ipsum dolor sit amet',
                'bcc' => 'Lorem ipsum dolor sit amet',
                'client_id' => 1,
            ],
        ];
        parent::init();
    }
}
