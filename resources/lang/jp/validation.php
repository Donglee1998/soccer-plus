<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
     */

    'accepted'             => 'The :attribute must be accepted.',
    'accepted_if'          => 'The :attribute must be accepted when :other is :value.',
    'active_url'           => 'The :attribute is not a valid URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => 'The :attribute must only contain letters.',
    'alpha_dash'           => 'The :attribute must only contain letters, numbers, dashes and underscores.',
    'alpha_num'            => 'The :attribute must only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file'    => 'The :attribute must be between :min and :max kilobytes.',
        'string'  => 'The :attribute must be between :min and :max characters.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => ':attribute が間違っています。',
    'current_password'     => 'The password is incorrect.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_equals'          => 'The :attribute must be a date equal to :date.',
    'date_format'          => '日付は正しい形式で入力してください。',
    'declined'             => 'The :attribute must be declined.',
    'declined_if'          => 'The :attribute must be declined when :other is :value.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => ':attributeフィールドの値が重複しています。',
    'email'                => ':attribute有効な電子メールアドレスでなければなりません。',
    'ends_with'            => 'The :attribute must end with one of the following: :values.',
    'enum'                 => 'The selected :attribute is invalid.',
    'exists'               => ':attributeを入力してください。',
    'exists_multiple'      => ':attributeを入力してください。',
    'member_position'      => ':attributeを選択してください。',
    'member_gender'        => ':attributeを選択してください。',
    'dominant_foot'        => ':attributeを選択してください。',
    'team_color'           => ':attributeを選択してください。',
    'match_extra_time'     => ':attributeを選択してください。',
    'match_penalty'        => ':attributeを選択してください。',
    'number_player'        => ':attributeを選択してください。',
    'match_type'           => ':attributeを選択してください。',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'The :attribute field must have a value.',
    'gt'                   => [
        'numeric' => ':attributeは:valueより大きくなければなりません。',
        'file'    => 'The :attribute must be greater than :value kilobytes.',
        'string'  => 'The :attribute must be greater than :value characters.',
        'array'   => 'The :attribute must have more than :value items.',
    ],
    'gte'                  => [
        'numeric' => 'The :attribute must be greater than or equal to :value.',
        'file'    => 'The :attribute must be greater than or equal to :value kilobytes.',
        'string'  => 'The :attribute must be greater than or equal to :value characters.',
        'array'   => 'The :attribute must have :value items or more.',
    ],
    'image'                => 'The :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'                  => ':attributeは半角数字のみで入力してください',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'lt'                   => [
        'numeric' => 'The :attribute must be less than :value.',
        'file'    => 'The :attribute must be less than :value kilobytes.',
        'string'  => 'The :attribute must be less than :value characters.',
        'array'   => 'The :attribute must have less than :value items.',
    ],
    'lte'                  => [
        'numeric' => 'The :attribute must be less than or equal to :value.',
        'file'    => 'The :attribute must be less than or equal to :value kilobytes.',
        'string'  => 'The :attribute must be less than or equal to :value characters.',
        'array'   => 'The :attribute must not have more than :value items.',
    ],
    'mac_address'          => 'The :attribute must be a valid MAC address.',
    'max'                      => [
        'numeric' => ':attributeを半角で入力してください',
        'file'    => 'The :attribute may not be greater than :max kilobytes.',
        'string'  => ':attributeは:max文字以下で入力してください。',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => ':attributeは少なくとも以下でなければなりません:min。',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => ':attributeは:min文字以上で入力してください。',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'multiple_of'          => 'The :attribute must be a multiple of :value.',
    'not_in'               => 'The selected :attribute is invalid.',
    'not_regex'            => 'The :attribute format is invalid.',
    'numeric'              => ':attribute数字である必要があります。',
    'password'             => 'The password is incorrect.',
    'present'              => 'The :attribute field must be present.',
    'prohibited'           => 'The :attribute field is prohibited.',
    'prohibited_if'        => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless'    => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits'            => 'The :attribute field prohibits :other from being present.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => ':attributeを入力してください。',
    'mb_required'          => ':attributeを入力してください。',
    'required_array_keys'  => 'The :attribute field must contain entries for: :values.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values are present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => ':otherと:attributeが異なっています。',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'max_mb'               => ':attributeは:max文字以下で入力してください。',
    'starts_with'          => 'The :attribute must start with one of the following: :values.',
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid timezone.',
    'unique'               => 'この:attributeは既に使用されています。',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'The :attribute must be a valid URL.',
    'uuid'                 => 'The :attribute must be a valid UUID.',
    'custom_check_active'  => ':attribute味方と相手ともスタメンを選択ください。',
    'status_line_ups'      => ':attributeを入力してください。',
    'count_multiple'       => 'スタメンの保存は最大5件です。',
    'lineup_starting'      => 'スタメンは11名の選手まで登録してください。',
    'lineup_active'        => ':attributeスタメンの保存は最大2件です。',
    'lineup_distinct'      => ':attributeフィールドの値が重複しています。',
    'lineup_active_distinct'        => ':attributeフィールドの値が重複しています。',
    'size_folder'          => "空き容量が足りないです。",
    'custom_unique'        => "この:attributeは既に使用されています。",
    'phone_valid'          => "電話番号を正しい形式で入力してください。",
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
     */

    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
     */

    'attributes'           => [
        'username' => '投稿者ID',
        'password' => '投稿者パスワード'
    ],
    'errors'               => [
        '404' => 'リクエストされたページは見つかりませんでした',
    ],

];
