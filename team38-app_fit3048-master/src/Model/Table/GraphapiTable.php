<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Graphapi Model
 *
 * @method \App\Model\Entity\Graphapi newEmptyEntity()
 * @method \App\Model\Entity\Graphapi newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Graphapi[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Graphapi get($primaryKey, $options = [])
 * @method \App\Model\Entity\Graphapi findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Graphapi patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Graphapi[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Graphapi|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Graphapi saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Graphapi[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Graphapi[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Graphapi[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Graphapi[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class GraphapiTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('graphapi');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('tenant_id')
            ->maxLength('tenant_id', 450)
            ->allowEmptyString('tenant_id');

        $validator
            ->scalar('client_id')
            ->maxLength('client_id', 450)
            ->allowEmptyString('client_id');

        $validator
            ->scalar('client_secret')
            ->maxLength('client_secret', 450)
            ->allowEmptyString('client_secret');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        return $validator;
    }
}
