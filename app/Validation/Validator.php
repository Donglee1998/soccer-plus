<?php

namespace App\Validation;

use App\Rules\MaxMb;
use Illuminate\Support\Arr;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;

class Validator
{
    /**
     * MbRequired rules.
     * Convention: 'mb_required' must have 'validateMbRequired' method name in that class.
     *
     * @var array
     */
    protected $rules = [
        'phone_valid',
        'zip_valid',
        'not_fullsize',
        'slug_valid',
        'mb_required',
        'max_mb',
        'member_position',
        'member_gender',
        'dominant_foot',
        'match_type',
        'team_color',
        'exists_multiple',
        'count_multiple',
        'status_line_ups',
        'custom_check_active',
        'match_penalty',
        'lineup_starting',
        'lineup_active',
        'lineup_distinct',
        'lineup_active_distinct',
        'contract_option',
        'size_folder',
        'custom_unique',
        'invalid',
    ];

    public function extend($validator)
    {
        foreach ($this->rules as $newRule) {
            $this->extendRule($validator, $newRule);
        }
    }

    protected function extendRule($validator, string $rule)
    {
        $method = $this->normalizeMethod($rule);

        if (!method_exists($this, $method)) {
            throw new \BadMethodCallException("Method [{$method}] does not exist.");
        }

        $validator->extend($rule, function ($attribute, $value, $parameters, $validator) use ($method) {
            return $this->$method($value, $attribute, $parameters, $validator);
        });
    }

    /**
     * Converts snake_case to StudlyCaps and adds "validate" prefix as first part.
     * Example: 'is_bool' will be 'validateIsBool'.
     *
     * @param string $rule
     * @return string
     */
    protected function normalizeMethod(string $rule)
    {
        return 'validate' . str_replace('_', '', ucwords($rule, '_'));
    }

    public function validateMbRequired($value)
    {
        $value = strip_tags($value);
        $value = str_replace(['&nbsp;', "\n"], '', $value);
        $value = trim($value, ' 　');
        if ($value) {
            return true;
        }

        return false;
    }

    public function validateMaxMb($value, $attribute, $parameters, $validator)
    {
        $validator->addReplacer('max_mb', function ($message, $attribute, $rule, $parameters) {
            $parameters = array_map(function ($parameter) {
                return number_format($parameter);
            }, $parameters);

            return str_replace([':max'], $parameters, $message);
        });

        $max_mb = new MaxMb($parameters);

        return $max_mb->passes($attribute, $value);
    }

    public function validateMemberPosition($value, $attribute, $parameters, $validator)
    {
        $config_member_position = config('constants.member_position.key');
        if (in_array($value, $config_member_position)) {
            return true;
        }
        return false;
    }

    public function validateMemberGender($value, $attribute, $parameters, $validator)
    {
        if (!$value) {
            return true;
        }
        $config_member_gender = config('constants.gender.key');
        if (in_array($value, $config_member_gender)) {
            return true;
        }
        return false;
    }

    public function validateDominantFoot($value, $attribute, $parameters, $validator)
    {
        $config_dominant_foot = config('constants.dominant_foot.key');
        if (in_array($value, $config_dominant_foot)) {
            return true;
        }
        return false;
    }

    public function validateMatchType($value, $attribute, $parameters, $validator)
    {
        if (!$value) {
            return true;
        }
        $match_type = config('constants.match_type.key');
        if (in_array($value, $match_type)) {
            return true;
        }
        return false;
    }

    public function validateTeamColor($value, $attribute, $parameters, $validator)
    {
        $color = array_keys(config('constants.team_color'));
        if (in_array($value, $color)) {
            return true;
        }
        return false;
    }

    protected function __parseParameterFormats($attribute, $parameters)
    {
        $search = collect($attribute)->map(function ($v, $k) use ($parameters) {
            if (str_contains($v, '*')) {
                $v = $parameters[$k] ?? $v;
                return $v;
            }
            return $v;
        })->toArray();
        return implode('.', $search);
    }
    /*
    Rules
    parameters[0] model class name   Ex : \App\Models\Example
    parameters[1] field table Ex : id
    parameters[2] field table Ex: team_id
    parameters[3] request key Ex : request()->team_id
    SQL :  select count(distinct `parameters[1]`) as aggregate from `table` where `parameters[1]` in ($value) and `parameters[2]` =  parameters[3]
     */
    public function validateExistsMultiple($value, $attribute, $parameters, $validator)
    {
        try {
            if (count($parameters) < 4) {
                throw new \InvalidArgumentException("Validation rule exists_multiple requires 4 parameters.");
            }
            $input    = $validator->getData();
            $verifier = $validator->getPresenceVerifier();
            if (!is_subclass_of($parameters[0], 'Illuminate\Database\Eloquent\Model')) {
                throw new \InvalidArgumentException("Validation rule exists_multiple requires namespace model class");
            }
            $collection = app($parameters[0])->getTable();
            $column     = $parameters[1];
            if (str_contains($parameters[3], "*")) {
                $parameters[3] = $this->__parseParameterFormats(explode('.', $parameters[3]), explode('.', $attribute));
            }
            $extra = [$parameters[2] => Arr::get($input, $parameters[3])];
            if (!empty($parameters[4])) {
                $column_explode            = explode(':', $parameters[4]);
                $extra[$column_explode[0]] = $column_explode[1];
            }
            $count = $verifier->getMultiCount($collection, $column, (array) $value, $extra);

            return $count >= 1;
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }

    public function validateCountMultiple($value, $attribute, $parameters, $validator)
    {
        if (count($parameters) < 3) {
            throw new \InvalidArgumentException("Validation rule count_multiple requires 3 parameters.");
        }
        $verifier = $validator->getPresenceVerifier();
        if (!is_subclass_of($parameters[0], 'Illuminate\Database\Eloquent\Model')) {
            throw new \InvalidArgumentException("Validation rule exists_multiple requires namespace model class");
        }
        $collection = app($parameters[0])->getTable();
        $column     = $parameters[1];
        $rule       = explode(':', $parameters[2]);
        $extra      = [$parameters[3] => request()->get($parameters[3])];
        $count      = $verifier->getCount($collection, $column, (array) $value, NULL, NULL,$extra);
        return $count < $rule[1];
    }

    public function validateStatusLineUps($value, $attribute, $parameters, $validator)
    {
        if (!$value) {
            return true;
        }
        $status = config('constants.line_ups.key.status');
        if (in_array($value, $status)) {
            return true;
        }
        return false;
    }

    public function validateCustomCheckActive($value, $attribute, $parameters, $validator)
    {
        if (count($parameters) < 2) {
            throw new \InvalidArgumentException("Validation rule count_multiple validateCustomCheckActive 3 parameters.");
        }
        $validator->addReplacer('custom_check_active', function ($message, $attribute, $rule, $parameters) {
            return str_replace([':equal'], $parameters[2], $message);
        });
        $input          = $validator->getData();
        $data_attribute = Arr::get($input, $attribute);
        if (is_array($data_attribute)) {
            $data_attribute = collect($data_attribute)->where($parameters[0], config($parameters[1]))->count();
            return $data_attribute == intval(str_replace('equal:', '', $parameters[2]));
        }
        return false;
    }

    public function validateMatchPenalty($value, $attribute, $parameters, $validator)
    {
        $rule = config('constants.penalty.key');
        if (in_array($value, $rule)) {
            return true;
        }
        return false;
    }

    public function validateLineupStarting($value, $attribute, $parameters, $validator)
    {
        try {
            $validator->addReplacer('lineup_starting', function ($message, $attribute, $rule, $parameters) {
                return str_replace([':max'], $parameters[0], $message);
            });
            if (count($parameters) < 1) {
                throw new \InvalidArgumentException("Validation rule validateLineupStarting 1 parameters.");
            }
            if (!empty($value)) {
                return count($value) <= intval(str_replace('max:', '', $parameters[0]));
            }
            return false;
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }

    public function validateLineupActive($value, $attribute, $parameters, $validator)
    {
        if (count($parameters) < 3) {
            throw new \InvalidArgumentException("Validation rule validateLineupActive requires 3 parameters.");
        }
        $verifier = $validator->getPresenceVerifier();
        if (!is_subclass_of($parameters[0], 'Illuminate\Database\Eloquent\Model')) {
            throw new \InvalidArgumentException("Validation rule exists_multiple requires namespace model class");
        }
        $collection = app($parameters[0])->getTable();
        $column     = $parameters[1];
        $extra      = [];
        $rule       = explode(':', $parameters[2]);
        if (!empty($parameters[3])) {
            $request         = request()->get('line_up');
            $line_up_active  = collect($request)->where('status', config('constants.line_ups.key.status.active'))->count();
            $extra['status'] = config('constants.line_ups.key.status.active');

        }
        $count = $verifier->getCount($collection, $column, (array) $value, $extra);
        if (!empty($line_up_active)) {
            $count = $count + $line_up_active;
        }

        return $count <= $rule[1];
    }

    public function validateLineupDistinct($value, $attribute, $parameters, $validator)
    {
        if (count($parameters) < 1) {
            throw new \InvalidArgumentException("Validation rule validateLineupDistinct requires 4 parameters.");
        }
        $list = [];

        $value = collect($value)->each(function ($data) use ($parameters, &$list) {
            collect($data)->only([$parameters[1], $parameters[2], $parameters[3]])->map(function ($item, $key) use (&$list, $parameters) {
                array_push($list, collect($item)->pluck($parameters[0])->toArray());

            });
        });
        $distinct = collect($this->_valuesEndless($list)[0])->duplicates();
        if (count($distinct) > 0) {
            return false;
        }
        return true;

    }

    public function validateLineupActiveDistinct($value, $attribute, $parameters, $validator)
    {
        if (count($parameters) < 1) {
            throw new \InvalidArgumentException("Validation rule validateLineupActiveDistinct requires 4 parameters.");
        }
        $input     = $validator->getData();
        $data      = Arr::get($input, $parameters[0]);
        $condition = explode(':', $parameters[2]);
        if (!empty($condition)) {
            $data     = collect($data)->where($condition[0], $condition[1])->pluck($parameters[1])->toArray();
            $distinct = collect($data)->duplicates();
            if (count($distinct) > 0) {
                return false;
            }
        }
        return true;
    }

    public function validateSlugValid($value, $attribute, $parameters, $validator)
    {
        if (!preg_match('/[@!#$%^&*()<>?\/|}{~:]/', $value)) {
            return true;
        }

        return false;
    }


    public function validatePhoneValid($value, $attribute, $parameters, $validator)
    {
        if (strlen($value) >= 7) {
            return is_numeric(str_replace('-', '', $value));
        }
        return false;
    }

    public function validateZipValid($value, $attribute, $parameters, $validator)
    {
        if (!strlen($value) == 0) {
            return (preg_match("/^[0-9]{7}$/", $value)) | (preg_match("/^[0-9]{3}-[0-9]{4}$/", $value)) | (preg_match("/^〒([0-9]{3}-[0-9]{4})$/", $value)) ;
        }
        return false;
    }

    public function ValidateNotFullsize($value, $attribute, $parameters, $validator)
    {
        if (!strlen($value) == 0) {
            return !(preg_match("/^[０-９]+$/", $value)) && !(preg_match("/[a-z]/", $value));
        }
        return false;
    }

    private function _valuesEndless(array $values): array
    {
        $final = [];
        array_walk_recursive($values, function ($item, $key) use (&$final) {
            $final[0][] = $item;
        });
        return $final;
    }


    public function validateContractOption($value, $attribute, $parameters, $validator)
    {
        if(in_array(config('constants.contract_option.key.play_by_play_video'), $value) && in_array(config('constants.contract_option.key.play_by_play_video_lite'), $value)) {
            return false;
        }
        return true;
    }

    public function validateSizeFolder($value, $attribute, $parameters, $validator)
    {
        $input      = $validator->getData();
        $video_kb = convertToKByte(Arr::get($input, $parameters[0])->getSize());
        $used_kb  = $parameters[1];
        $space_kb = $parameters[2];

        return (($video_kb + $used_kb) <= $space_kb);
    }

    public function validateCustomUnique($value, $attribute, $parameters, $validator)
    {
        $user  = Auth::guard('web')->user();

        if (!empty($user)) {
            $model = 'App\Models\\'. $parameters[0];
            if (!empty($parameters[2])) {
                $listItems = $model::where($parameters[1], $parameters[2])->where('created_by', $user->id);
                return !($listItems->count() > 0);
            }
        }

        return false;
    }

    public function validateInvalid($value, $attribute, $parameters, $validator)
    {
        return false;
    }
}
