<?php
declare(strict_types=1);

namespace App\Model\Behavior;

use Cake\I18n\FrozenDate;
use Cake\ORM\Behavior;
use PHPUnit\Util\Exception;

/**
 * RequestDataConvert behavior
 * HasManyデータへの変換処理
 *
 * todo 子モデルが日付のフィールド以外にも対応させる
 */
class RequestDataConvertBehavior extends Behavior
{
    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [
        'key' => 'event_dates',
        'childrenKey' => 'date',
        'foreignKeyField' => 'event_id',
        'separator' => ',',
        'validateMethod' => null,
        'childrenPrimaryKey' => 'id',
    ];

    /**
     * @param  array  $requestData  request_data
     * @return array
     * @throws \Exception
     */
    public function convertForInsert(array $requestData): array
    {
        $key = $this->getConfig('key');
        $value = $requestData[$key] ?? '';
        if (empty($value)) {
            return $requestData;
        }

        $exploded = $this->_explode($value);
        if (! $this->isValid($exploded)) {
            throw new \Exception('引数$requestDataの値が不正です');
        }

        $requestData[$key] = $this->createInsertData($exploded);

        return $requestData;
    }

    /**
     * @param  array  $requestData  request_data
     * @param  \Cake\Datasource\EntityInterface[]  $entities  entities
     * @return array
     * @throws \Exception
     */
    public function convertForUpdate(array $requestData, array $entities): array
    {
        $key = $this->getConfig('key');
        $value = $requestData[$key] ?? '';
        if (empty($value)) {
            return $requestData;
        }

        $exploded = $this->_explode($value);
        if (! $this->isValid($exploded)) {
            throw new \Exception('引数$requestDataの値が不正です');
        }

        $result = $this->createUpdateData($entities, $exploded);
        $requestData[$key] = $result;

        return $requestData;
    }

    /**
     * @param  array  $array array
     * @return bool
     */
    public function isValid(array $array): bool
    {
        $validateMethod = $this->getConfig('validateMethod');
        foreach ($array as $value) {
            if (! is_callable($validateMethod)) {
                return true;
            }

            if ($validateMethod($value) === false) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param  string  $value  value
     * @return array
     */
    private function _explode(string $value): array
    {
        if (empty($value)) {
            throw new Exception('引数の値が不正です');
        }

        $separator = $this->getConfig('separator');
        if (strpos($value, $separator) !== false) {
            //empty($value)のチェックをしているのでexplodeの返り値はfalseにはならない(php7.4
            /** @var array $explode */
            $explode = explode($separator, $value);
            $array = array_map('trim', $explode);
        } else {
            $array = (array)trim($value);
        }

        return $array;
    }

    /**
     * @param  array  $specificRequestData  specific_request_data
     * @return array
     * @throws \Exception
     */
    public function createInsertData(array $specificRequestData): array
    {
        $result = [];
        $field = $this->getConfig('childrenKey');
        foreach ($specificRequestData as $value) {
            $result[] = [$field => $value];
        }

        return $result;
    }

    /**
     * @param  \Cake\Datasource\EntityInterface[]  $entities  entities
     * @param  array<string>  $requests requests
     * @return array
     */
    public function createUpdateData(array $entities, array $requests): array
    {
        $field = $this->getConfig('childrenKey');
        $primaryKey = $this->getConfig('childrenPrimaryKey');
        $collection = new \Cake\Collection\Collection($entities);
        $originals = $collection
            ->each(function ($value, $key) use ($field) {
                if ($value[$field] instanceof FrozenDate) {
                    $value[$field] = $value[$field]->toDateString();
                }
            })
            ->combine($primaryKey, $field)
            ->toArray();
        $result = [];
        foreach ($requests as $request) {
            if (in_array($request, $originals, true)) {
                $result[] = [
                    $primaryKey => array_search($request, $originals),
                    $field => $request,
                ];
            } else {
                $result[] = [
                    $field => $request,
                ];
            }
        }

        return $result;
    }
}
