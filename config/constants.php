<?php
return [
    'site_title'              => 'サッカープラス',
    'gender'                  => [
        'label' => [
            '0' => '未選択',
            '1' => '男子',
            '2' => '女子',
        ],
        'key'   => [
            'unselected' => '0',
            'male'       => '1',
            'female'     => '2',
        ],
    ],
    'pic_gender'              => [
        'label' => [
            '1' => '男性',
            '2' => '女性',
        ],
        'key'   => [
            'male'   => '1',
            'female' => '2',
        ],
    ],
    'member_position'         => [
        'label' => [
            '0' => '?',
            '1' => 'GK',
            '2' => 'DF',
            '3' => 'MF',
            '4' => 'FW',
        ],
        'key'   => [
            'unselected' => '0',
            'GK'         => '1',
            'DF'         => '2',
            'MF'         => '3',
            'FW'         => '4',
        ],
    ],
    'dominant_foot'           => [
        'label' => [
            '1' => '未選択',
            '2' => '左',
            '3' => '右',
            '4' => '両利き',
        ],
        'key'   => [
            'unselected' => '1',
            'left'       => '2',
            'right'      => '3',
            'two_hand'   => '4',
        ],
    ],
    'match_type'              => [
        'label' => [
            '1' => '練習試合',
            '2' => '公式試合',
            '3' => '研究用',
        ],
        'key'   => [
            'practice' => '1',
            'official' => '2',
            'research' => '3',
        ],
    ],
    'match_time'              => [
        'label' => [
            '1' => '前後半',
            '2' => '休憩',
        ],
        'key'   => [
            'first_half' => '1',
            'rest'       => '2',
        ],
    ],
    'match_status'            => [
        'key' => [
            'not_start' => 1,
            'started'   => 2,
            'ended'     => 3,
        ],
    ],
    'match_extra_time'        => [
        1  => '無し',
        15 => '15分',
        10 => '10分',
        5  => '5分',
    ],
    'penalty'                 => [
        'label' => [
            '1' => '有り',
            '2' => '無し',
        ],
        'key'   => [
            'yes' => '1',
            'no'  => '2',
        ],
    ],
    'situation'               => [
        'label' => [
            '1' => '良',
            '2' => '悪',
        ],
        'key'   => [
            'good' => '1',
            'bad'  => '2',
        ],
    ],
    'sub_action_pass_dribble' => [
        'label' => [
            '1' => 'パス',
            '2' => 'ドリブル',
        ],
        'key'   => [
            'pass'    => '1',
            'dribble' => '2',
        ],
    ],
    'sub_action_offense'      => [
        'label' => [
            '1'  => '不明',
            '2'  => 'トリッピング',
            '3'  => 'ホールディング',
            '4'  => 'GK6秒保持',

            '5'  => 'ハンドリング',
            '6'  => 'ストライキング',
            '7'  => 'スピッティング',
            '8'  => 'FK連続接触',

            '9'  => 'キッキング',
            '10' => 'ファウルチャージ',
            '11' => 'プッシング',
            '12' => 'TI連続接触',

            '13' => 'ジャンピングアット',
            '14' => '対GKファウル',
            '15' => 'オブストラクション',
            '16' => 'シミュレーション',
        ],
        'key'   => [
            'unknown'                  => '1',
            'tripping'                 => '2',
            'holding'                  => '3',
            'gk_6_second_hold'         => '4',

            'handling'                 => '5',
            'striking'                 => '6',
            'spitting'                 => '7',
            'fk_collides_continuously' => '8',

            'Kicking'                  => '9',
            'Foul charge'              => '10',
            'pushing'                  => '11',
            'tl_collides_continuously' => '12',

            'jumping_at'               => '13',
            'anti_gk_foul'             => '14',
            'obstruction'              => '15',
            'simulation'               => '16',
        ],
    ],
    'decision'                => [
        'label' => [
            '1' => 'なし(注意)',
            '2' => 'イエロー(警告)',
            '3' => 'レッド(退場)',
        ],
        'key'   => [
            'no'     => '1',
            'yellow' => '2',
            'red'    => '3',
        ],
    ],
    'action_result'           => [
        'label' => [
            '1' => '成功',
            '0' => '失敗',
        ],
        'key'   => [
            'successed' => '1',
            'failure'   => '0',
        ],
    ],
    'action_offense_result'   => [
        'key' => [
            'no_error'     => '1',
            'caught_error' => '2',
        ],
    ],
    'act_group'               => [
        'label' => [
            '1' => '攻撃',
            '2' => '守備',
            '3' => 'ゴールキーパー',
            '4' => '下部ボタン',
        ],
        'key'   => [
            'attack'        => '1',
            'defensive'     => '2',
            'goalkeeper'    => '3',
            'bottom_button' => '4',
        ],
    ],
    'line_ups'                => [
        'key' => [
            'status' => [
                'active'    => '1',
                'in_active' => '0',
            ],
        ],
    ],
    'limit'                   => 20,
    'team_color'              => [
        '1'  => '#FFF',
        '2'  => '#CCC',
        '3'  => '#666',
        '4'  => '#222',
        '5'  => '#FFA500',
        '6'  => '#FED701',
        '7'  => '#AE7F21',
        '8'  => '#EE7900',
        '9'  => '#D2003A',
        '10' => '#911A3A',
        '11' => '#008136',
        '12' => '#175340',
        '13' => '#DD71A8',
        '14' => '#C7007D',
        '15' => '#61227E',
        '16' => '#96327B',
        '17' => '#05509F',
        '18' => '#042450',
        '19' => '#1E3E7A',
        '20' => '#0095D8',
    ],
    'news_category'           => [
        'label' => [
            '1' => '使い方',
            '2' => 'お知らせ',
        ],
        'key'   => [
            'manual' => '1',
            'news'   => '2',
        ],
    ],
    'news_sub_category'       => [
        'label' => [
            '1' => 'お知らせ',
            '2' => '受賞歴 ',
        ],
        'key'   => [
            'news'   => '1',
            'awards' => '2',
        ],
    ],
    'setting_public'          => [
        'label' => [
            '1' => '公開',
            '2' => '非公開',
        ],
        'key'   => [
            'public'  => '1',
            'private' => '2',
        ],
    ],
    'tactic_type'             => [
        'label' => [
            '1' => '攻撃',
            '2' => '守備',
        ],
        'key'   => [
            'attack'  => '1',
            'defense' => '2',
        ],
    ],
    'tactic_status'           => [
        'label' => [
            '1' => '血島且罰',
            '2' => 'コーナーキック',
            '3' => 'フリーキック',
            '4' => 'スローイン',
        ],
        'key'   => [
            'attack'      => '1',
            'corner_kick' => '2',
            'free_kick'   => '3',
            'throw_in'    => '4',
        ],
    ],
    'tactic_pitch'            => [
        'label' => [
            '1' => 'フル',
            '2' => '自陣',
            '3' => '敵陣',
        ],
        'key'   => [
            'full'        => '1',
            'home_pitch'  => '2',
            'enemy_pitch' => '3',
        ],
    ],
    'pitch'                   => [
        'label' => [
            '1' => 'フル',
            '2' => '自陣',
            '3' => '敵陣',
        ],
        'key'   => [
            'full' => '1',
            'home' => '2',
            'away' => '3',
        ],
    ],
    'pitch_type'              => [
        'label' => [
            '1' => '土',
            '2' => '人工芝',
            '3' => '天然芝',
        ],
        'key'   => [
            'soil'       => '1',
            'artificial' => '2',
            'natural'    => '3',
        ],
    ],
    'weather'                 => [
        'label' => [
            '1' => '晴れ',
            '2' => '曇り',
            '3' => '雨',
            '4' => '雪',
        ],
        'key'   => [
            'sunny'  => '1',
            'cloudy' => '2',
            'rain'   => '3',
            'snow'   => '4',
        ],
    ],
    'is_home'                 => '1',
    'team_own'                => [
        'label' => [
            '1' => 'ホーム',
            '2' => 'アウェイ',
        ],
        'key'   => [
            'home' => '1',
            'away' => '2',
        ],
    ],
    'action_map'              => [
        'kick'                => [
            'id'    => 1,
            'title' => 'シュート',
        ],
        'pass'                => [
            'id'    => 2,
            'title' => 'ドリブル',
        ],
        'cross'               => [
            'id'    => 3,
            'title' => 'クロス',
        ],
        'infiltrate_pa'       => [
            'id'    => 4,
            'title' => 'PA侵入',
        ],
        'infiltrate_line_30m' => [
            'id'    => 5,
            'title' => '30mライン侵入',
        ],
        'clear'               => [
            'id'    => 6,
            'title' => 'クリア',
        ],
        'tackle'              => [
            'id'    => 7,
            'title' => 'タックル',
        ],
        'block'               => [
            'id'    => 8,
            'title' => 'ブロック',
        ],
        'intercept'           => [
            'id'    => 9,
            'title' => 'インターセプト',
        ],
        'catching'            => [
            'id'    => 10,
            'title' => 'キャッチング',
        ],
        'punching'            => [
            'id'    => 11,
            'title' => 'パンチング',
        ],
        'punt_kick'           => [
            'id'    => 12,
            'title' => 'パントキック',
        ],
        'throw_ball'          => [
            'id'    => 13,
            'title' => 'スローイング',
        ],
        'tackle_overhead'     => [
            'id'    => 14,
            'title' => '空中戦',
        ],
        'second_ball'         => [
            'id'    => 15,
            'title' => 'セカンドボール',
        ],
        'dominance'           => [
            'id'    => 16,
            'title' => 'アドバンテージ',
        ],
        'offense'             => [
            'id'    => 17,
            'title' => 'ファウル',
        ],
        'restart'             => [
            'id'    => 18,
            'title' => '再開',
        ],
        'out_of_goal_line'    => [
            'id'    => 19,
            'title' => 'ゴールラインアウト',
        ],
        'beyond_border'       => [
            'id'    => 20,
            'title' => 'タッチラインアウト',
        ],
        'offside'            => [
            'id'    => 21,
            'title' => 'オフサイド',
        ],
        'referee_pause'       => [
            'id'    => 22,
            'title' => '主審による停止',
        ],
        'no_action'           => [
            'id'    => 23,
            'title' => 'なし',
        ],
        'saving'              => [
            'id'    => 24,
            'title' => 'セービング',
        ],
        'fumble'              => [
            'id'    => 25,
            'title' => 'ファンブル',
        ],
        'assist'              => [
            'id'    => 26,
            'title' => 'アシスト',
        ],
        'second_assist'       => [
            'id'    => 27,
            'title' => 'アシスト前パス',
        ],
        'key_pass'            => [
            'id'    => 28,
            'title' => 'キーパス',
        ],
        'ball_cutting'        => [
            'id'    => 29,
            'title' => 'カット',
        ],
        'out_of_play'         => [
            'id'    => 30,
            'title' => 'アウトオブプレー',
        ],
        'foul'                => [
            'id'    => 31,
            'title' => 'ファウル',
        ],
        'corner_kick'         => [
            'id'    => 32,
            'title' => 'コーナーキック',
        ],
        'goal_kick'           => [
            'id'    => 33,
            'title' => 'ゴールキック',
        ],
        'throw_from_the_side' => [
            'id'    => 34,
            'title' => 'スローイン',
        ],
        'offside'             => [
            'id'    => 35,
            'title' => 'オフサイド',
        ],
        'change_player'       => [
            'id'    => 36,
            'title' => '選手交代',
        ],
        'early_cross'         => [
            'id'    => 37,
            'title' => 'アーリークロス',
        ],
        'fouled'              => [
            'id'    => 38,
            'title' => '被ファウル',
        ],
        'end_of_match'        => [
            'id'    => 39,
            'title' => '試合終了',
        ],
        'penalties_kick'      => [
            'id'    => 40,
            'title' => 'PK',
        ],
        'change_member_in'    => [
            'id'    => 41,
            'title' => '選手交代(IN)',
        ],
        'change_member_out'   => [
            'id'    => 42,
            'title' => '選手交代(OUT)',
        ],
        'change_round'        => [
            'id'    => 43,
            'title' => '終了',
        ],
        'direct_free_kick'    => [
            'id'    => 44,
            'title' => '直接フリーキック',
        ],
        'indirect_free_kick'  => [
            'id'    => 45,
            'title' => '間接フリーキック',
        ],
        'pk_free_kick'        => [
            'id'    => 46,
            'title' => 'PKフリーキック',
        ],
        'unknown_1st'         => [
            'id'    => 47,
            'title' => '?',
        ],
        'free_kick'           => [
            'id'    => 48,
            'title' => 'フリーキック',
        ],
        'change_dmf'          => [
            'id'    => 49,
            'title' => 'フォーメーション変更',
        ],
        'gk_action_left'      => [
            'id'    => 50,
            'title' => '左',
        ],
        'gk_action_center'    => [
            'id'    => 51,
            'title' => '中央',
        ],
        'gk_action_right'     => [
            'id'    => 52,
            'title' => '右',
        ],
        'gk_action_stop'      => [
            'id'    => 53,
            'title' => 'ストップ',
        ],
        'offside_trap'      => [
            'id'    => 54,
            'title' => 'オフサイド',
        ],
    ],
    'stat_order'              => [
        'key' => [
            'above' => '0',
            'below' => '1',
        ],
    ],

    'per_page'                => [
        'default' => 20,
    ],
    'contract_premium1'       => [
        'label' => [
            '1' => 'ホワイト',
            '2' => 'ブラック',
        ],
        'key'   => [
            'white' => '1',
            'black' => '2',
        ],
    ],
    'contract_premium2'       => [
        'label' => [
            '1' => '希望しない',
            '2' => 'ホワイト',
            '3' => 'ブラック',
        ],
        'key'   => [
            'nothing' => '1',
            'white'   => '2',
            'black'   => '3',
        ],
    ],
    'contract_premium3'       => [
        'label' => [
            '1' => '希望しない',
            '2' => 'ホワイト',
            '3' => 'ブラック',
        ],
        'key'   => [
            'nothing' => '1',
            'white'   => '2',
            'black'   => '3',
        ],
    ],
    'contract_option'         => [
        'label' => [
            '1' => 'オリジナルIpadカバー',
            '2' => 'エキスパートサーバーモデル',
            '3' => 'タブレットサポート',
            '4' => 'タブレット安心サポート',
            '5' => 'Play by Play Video',
            '6' => 'Play by Play Videoライト',
            '7' => '請求書発行サービス（電子メール）',
            '8' => '領収書発行サービス（電子メール）',
        ],
        'key'   => [
            'original_ipad_cover'                => '1',
            'expert_server_model'                => '2',
            'tablet_support'                     => '3',
            'tablet_relief_support'              => '4',
            'play_by_play_video'                 => '5',
            'play_by_play_video_lite'            => '6',
            'invoicing_service_via_email'        => '7',
            'receipt_issuance_service_via_email' => '8',
        ],
    ],
    'payment_method1'         => [
        'label' => [
            '1' => '年払い',
            '2' => '半年払い',
            '3' => '月払い',
        ],
        'key'   => [
            'yearly'      => '1',
            'half_yearly' => '2',
            'monthly'     => '3',
        ],
    ],
    'payment_method2'         => [
        'label' => [
            '1' => 'クレジットカード',
            '2' => '銀行口座自動振替',
            '3' => '銀行振込',
        ],
        'key'   => [
            'credit_card'             => '1',
            'automatic_bank_transfer' => '2',
            'bank_transfer'           => '3',
        ],
    ],
    'contract_status'         => [
        'label' => [
            '1' => '新規申し込み',
            '2' => '契約中',
            '3' => '解約済み',
        ],
        'key'   => [
            'new'      => '1',
            'contract' => '2',
            'canceled' => '3',
        ],
    ],
    'registration_type'       => [
        'label' => [
            '1' => 'pro',
            '2' => 'standard',
        ],
    ],
    'period_aggregation'      => [
        'match_type' => [
            'label' => [
                '0' => 'すべて',
                '1' => '練習試合',
                '2' => '公式試合',
                '3' => '研究用',
            ],
            'key'   => [
                'all'      => '0',
                'practice' => '1',
                'official' => '2',
                'research' => '3',
            ],
        ],
    ],

    'contact'                 => [
        'status'   => [
            'label' => [
                '1' => '未対応',
                '2' => '対応中',
                '3' => '対応済み',
            ],
            'key'   => [
                'waiting'    => '1',
                'in_process' => '2',
                'accept'     => '3',
            ],
            'class' => [
                '1' => 'stType01',
                '2' => 'stType02',
                '3' => 'stType03',
            ],
        ],

        'app_type' => [
            'label' => [
                '1' => 'iPadレンタル版アプリ',
                '2' => 'AppStore版アプリ',
                '3' => 'わからない',
            ],
            'key'   => [
                'ipad'     => '1',
                'AppStore' => '2',
                'other'    => '3',
            ],
        ],
        'purpose'  => [
            'label' => [
                '1' => 'オンラインでの案内希望',
                '2' => '利用中のアプリについてのお問い合わせ',
                '3' => 'その他のお問い合わせ',
            ],
            'key'   => [
                'online_guidance' => '1',
                'app_using'       => '2',
                'other'           => '3',
            ],
        ],
        'type'     => [
            'key' => [
                'user'  => '1',
                'admin' => '2',
            ],
        ],
    ],
    'pbpv'                    => [
        'goal_actions'  => ['1', '46'],
        'pd_actions'    => ['991', '992', '1', '4', '5', '3', '7', '14', '15', '44', '45', '46', '32'],
        'receive_point' => [
            'id'   => '991',
            'name' => '得点',
        ],
        'lost_point'    => [
            'id'   => '992',
            'name' => '失点',
        ],
        'space_upload'  => [
            'standard_mb'  => env('PBPV_SPACE_UPLOAD_STANDARD_MB', 46080),
            'lite_mb'      => env('PBPV_SPACE_UPLOAD_LITE_MB', 23040),
            'file_mb'      => env('PBPV_SPACE_UPLOAD_FILE_MB', 1024),
            'default_unit' => env('PBPV_SPACE_UPLOAD_DEFAULT_UNIT', 'MB'),
            'chunk_mb' => 10,
        ],
        'valid_video_types' => ['mp4', 'avi', 'flv', 'mov', 'wmv'],
    ],
    'goal_numbers'            => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15],
    'sync'                    => [
        'no_contract_message' => 'エキスパートサーバーモデルがサポートしていないので、サーバに送信できません。',
    ],
    'gk_actions'              => [
        'label' => [
            '1' => 'なし',
            '2' => 'セービング',
            '3' => 'パンチング',
            '4' => 'キャッチング',
            '5' => 'ファンブル',
        ],
        'key'   => [
            'no'         => 1,
            'saving'     => 2,
            'punch_ball' => 3,
            'catch_ball' => 4,
            'punt_kick'  => 5,
        ],
    ],
    'kick_situation'          => [
        'label' => [
            '1'  => 'セットプレー直接',
            '2'  => 'セットプレーから',
            '3'  => 'クロスから',
            '4'  => 'スルーパスから',
            '5'  => 'ショートパスから',
            '6'  => 'ロングパスから',
            '7'  => 'ドリブルから',
            '8'  => 'こぼれ球から',
            '9'  => 'ショートカウンター',
            '10' => 'その他',
        ],
        'key'   => [
            'set_play_direct'    => 1,
            'kick_from_set_play' => 2,
            'cross'              => 3,
            'through_pass'       => 4,
            'short_pass'         => 5,
            'long_pass'          => 6,
            'pass'               => 7,
            'overflow'           => 8,
            'short_counter'      => 9,
            'other'              => 10,
        ],
    ],
    'queue_now' => env('QUEUE_NOW', true),
    'half_time' => [
        '1st_half_time' => [15, 20, 45],
        '2st_half_time' => [60, 75, 90]
    ],
];
