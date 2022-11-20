<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
/**
 * User Entity
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $user_type
 * @property string|null $user_email
 * @property string|null $user_password
 * @property string|null $passkey
 * @property \Cake\I18n\FrozenTime|null $timeout
 * @property \Cake\I18n\FrozenTime|null $registered_timestamp
 *
 * @property \App\Model\Entity\File[] $files
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'user_firstname' => true,
        'user_lastname' => true,
        'user_phone' => true,
        'user_type' => true,
        'user_email' => true,
        'user_password' => true,
        'passkey' => true,
        'timeout' => true,
        'registered_timestamp' => true,
        'files' => true,
    ];

    protected $_hidden = [
        'user_password'
    ];

    protected function _setUserPassword($value)
    {
        if (strlen($value)) {
            $hasher = new DefaultPasswordHasher();

            return $hasher->hash($value);
        }
    }
}
