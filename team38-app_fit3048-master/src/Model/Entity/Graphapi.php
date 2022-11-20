<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Graphapi Entity
 *
 * @property int $id
 * @property string|null $tenant_id
 * @property string|null $client_id
 * @property string|null $client_secret
 * @property string|null $email
 */
class Graphapi extends Entity
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
        'tenant_id' => true,
        'client_id' => true,
        'client_secret' => true,
        'email' => true,
    ];
}
