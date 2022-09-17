<?php
namespace App\Http\Utils;

use App\Models\GenerateCode;

class CodeUtil {
    static function generateCode($group = null)
    {
        $code = GenerateCode::where('data_group', $group)->first();
        $prefixCount = strlen($code->data_prefix);

        $olddata_value = substr($code->data_value, $prefixCount);

        $new_value = (int) $olddata_value + 1;

        $count = (int) $code->max_length - strlen($new_value);

        for ($i = 0; $i < $count; $i++) {
            $new_value = '0' . (string) $new_value;
            $strValue = (string) $new_value;
        }

        $newdata_value = $code->data_prefix . $strValue;

        $code->data_running += 1;

        $code->data_value = $newdata_value;

        $code->save();

        return $newdata_value;
    }

    public static function getLastCode($group)
    {
        $last = GenerateCode::select('data_value')->where('data_group', $group)->first();
        $nextCode = ++ $last->data_value;
        return $nextCode ?? null;
    }
}
