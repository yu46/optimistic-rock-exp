<?php
declare(strict_types=1);

namespace App\Model\Validation;

use Cake\Validation\Validation;

class CustomValidation extends Validation
{
    /**
     * @param mixed $check value
     * @return bool
     */
    public static function alphaNumeric($check): bool
    {
        return (bool)preg_match('/^[0-9a-zA-Z]+$/', $check);
    }

    /**
     * @param string $value value
     * @return bool
     */
    public static function kana(string $value): bool
    {
        return (bool)preg_match('/^[ァ-ヶー・･ 　]+$/u', $value);
    }

    /**
     * 10:00, 10:30, 11:30の場合true
     * 12:12, 14:01の場合false
     *
     * @param string $value time
     * @return bool
     */
    public static function every30min(string $value): bool
    {
        return (bool)preg_match('/\A([01][0-9]|2[0-3]):[0|3]0\Z/', $value);
    }

    /**
     * 10:00, 10:15, 10:30の場合true
     * 12:12, 14:01の場合false
     *
     * @param string $value time
     * @return bool
     */
    public static function every15min(string $value): bool
    {
        return (bool)preg_match('/\A([01][0-9]|2[0-3]):(00|15|30|45)\Z/', $value);
    }

    /**
     * 終了日時は開始日時より前には設定できないよう検証
     * publish_toなどの終了日時のフィールドで使う
     *
     * @param string $value date
     * @param string $fromField 比較するフィールド名
     * @param array $context context
     * @return bool
     */
    public static function dateOrder(string $value, string $fromField, array $context): bool
    {
        if ($value === '') {
            return true;
        }

        if (empty($context['data'][$fromField])) {
            return true;
        }
        if (!self::validateTime($value)) {
            throw new \InvalidArgumentException();
        }

        $from = $context['data'][$fromField];
        if (!self::validateTime($from)) {
            throw new \InvalidArgumentException();
        }

        return $value >= $from;
    }

    /**
     * @param  string  $value  value
     * @return bool
     */
    private static function validateTime(string $value): bool
    {
        $pattern = '/\A([01]\d|2[0-3])(:[0-5]\d){1,2}\Z/';
        if (preg_match($pattern, $value)) {
            return true;
        }

        return false;
    }
}
