<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Message Entity
 *
 * @property int $id
 * @property string|null $body
 * @property \Cake\I18n\FrozenTime|null $date
 * @property string|null $subject
 * @property string|null $sender
 * @property string|null $receiver
 * @property string|null $cc
 * @property string|null $bcc
 * @property int|null $client_id
 *
 * @property \App\Model\Entity\User $user
 */
class Message extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'body' => true,
        'date' => true,
        'subject' => true,
        'sender' => true,
        'receiver' => true,
        'cc' => true,
        'client_id' => true,
        'user' => true,
    ];
}
