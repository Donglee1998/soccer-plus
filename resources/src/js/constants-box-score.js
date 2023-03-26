const BOX_SCORE_TYPES = {
    NUMBER: {
        id: 1,
        title: '数値を見る'
    },
    PROBABILITY: {
        id: 2,
        title: '確率を見る'
    },
};

const BOX_SCORE_PERSONAL_COLUMN_NAME = {
    [BOX_SCORE_TYPES.NUMBER.id]: {
        id: 1,
        title: '数値を見る',
        columns_name: {
            // //1. Số áo
            // 1: 'No.',

            // //2. Vị trí
            // 2: 'POS',

            // //3. Tên
            // 3: '選手名',

            //4. Thời gian ra sân
            //4: '出場時間',

            //5. Ghi bàn
            5: 'ゴール',

            //6. Sút bóng
            6: 'シュート',

            //7. Sút bóng tới gôn
            7: '枠内シュート',

            //8. Kiến tạo
            8: 'アシスト',

            //9. Đường chuyền cuối
            9: 'ラストパス',

            //10. Cross
            10: 'クロス',

            //11. Số lần chuyền bóng thành công
            11: 'ドリブル成功',

            //12. Bị đối phương phạm lỗi
            12: '被ファウル',

            //13. Tắc bóng
            13: 'タックル',

            //14. Cướp bóng
            14: 'ボール奪取',

            //15. Chặn bóng
            15: 'インターセプト',

            //16. Block sút bóng
            16: 'シュートブロック',

            //17. Block cross bóng
            17: 'クロスブロック',

            //18. Phạm luật
            18: 'ファウル',

            //19. Clear
            19: 'クリア',

            //20. Cướp bóng tràn
            20: 'こぼれ球奪取',

            //21. Số lần đá phạt góc
            21: 'コーナーキック',

            //22. Số lần free kick
            22: 'フリーキック(敵陣)',

            //23. PK
            23: 'PK',

            //24. Tranh đc bóng trên không trên sân nhà
            24: '自陣空中戦勝利',

            //25. Tranh đc bóng trên không trên sân khách
            25: '敵陣空中戦勝利',

            //26. Số lần bị đối phương sút bóng
            26: '被シュート',

            //27. Số lần bị đối phương sút bóng tới gôn
            27: '被枠内シュート',

            //28. Mất điểm
            28: '失点',

            //29. Save sút bóng
            29: 'シュートセーブ ',

            //30. Save sút bóng trong Penalty area
            30: 'エリア内シュートセーブ',

            //31. Bắt cross (Đấm bóng)
            31: 'クロスキャッチ(パンチング)',

            //32. 自陣パス成功
            32: '自陣パス成功',

            //33. 敵陣パス成功
            33: '敵陣パス成功',

            //34. Độ đóng góp
            34: '貢献度',
        },
    },
    [BOX_SCORE_TYPES.PROBABILITY.id]: {
        id: 2,
        title: '確率を見る',
        columns_name: {
            // //1. Số áo
            // 1: 'No.',

            // //2. Vị trí
            // 2: 'POS',

            // //3. Tên
            // 3: '選手名',

            //4. Tỷ lệ ghi bàn
            4: '決定率',

            //5. Tỷ lệ sút bóng tới gôn
            5: '枠内シュート率',

            //6. Tỷ lệ tranh bóng trên không ở sân nhà
            6: '自陣空中戦勝利率',

            //7. Tỷ lệ tranh bóng trên không ở sân địch
            7: '敵陣空中戦勝利率',

            //8. Tỷ lệ chuyền bóng thành công
            8: 'ドリブル成功率',

            //9. Tỷ lệ cross thành công
            9: 'クロス成功率',

            //10. Tỷ lệ cướp bóng
            10: 'ボール奪取率',

            //11. Tỷ lệ clear thành công
            11: 'クリア成功率',

            //12. Tỷ lệ thu hồi bóng hai thành công
            12: 'セカンドボール回収率',

            //13. Tỷ lệ save sút bóng
            13: 'シュートセーブ率',

            //14. Tỷ lệ bắt bóng cross
            14: 'クロスキャッチ率',

            //15 Tỷ lệ mất điểm
            15: '失点率',
        },
    },
};

const BOX_SCORE_TEAM_COLUMN_NAME = {
    [BOX_SCORE_TYPES.NUMBER.id]: {
        id: 1,
        title: '数値を見る',
        columns_name: {
            // Ghi bàn
            1: '得点',

            // Sút bóng
            2: 'シュート',

            // Sút bóng tới gôn
            3: '枠内シュート',

            // Kiến tạo
            4: 'アシスト',

            // Đường chuyền cuối
            5: 'ラストパス',

            // Cross
            6: 'クロス',

            // Số lần chuyền bóng thành công
            7: 'ドリブル成功',

            // Bị đối phương phạm lỗi
            8: '被ファウル',

            // Cắt bóng
            9: 'カット',

            // Clear
            10: 'クリア',

            // Block
            11: 'ブロック',

            // Phạm luật
            12: 'ファウル',

            // Cướp bóng tràn
            13: 'こぼれ球奪取',

            // Xâm nhập PA
            14: 'PA侵入',

            // Số lần đá phạt gôn
            15: 'ゴールキック',

            // Số lần đá phạt góc
            16: 'コーナーキック',

            // Free kick (Đá trực tiếp)
            17: 'フリーキック(直接フリーキック)',

            // Số lần đá PK
            18: 'PK',

            // Tranh đc bóng trên không  trên sân nhà
            19: '自陣空中戦勝利',

            // Tranh đc bóng trên không  trên sân khách
            20: '敵陣空中戦勝利',

            // Save
            21: 'セーブ',
        },
    },
    [BOX_SCORE_TYPES.PROBABILITY.id]: {
        id: 2,
        title: '確率を見る',
        columns_name: {
            // Tỷ lệ ghi bàn
            1: '決定率',

            // Tỷ lệ sút bóng tới gôn
            2: '枠内シュート率',

            // Tỷ lệ tranh bóng trên không ở sân nhà
            3: '自陣空中戦勝利率',

            // Tỷ lệ tranh bóng trên không ở sân địch
            4: '敵陣空中戦勝利率',

            // Tỷ lệ chuyền bóng thành công
            5: 'ドリブル成功率',

            // Tỷ lệ cross thành công
            6: 'クロス成功率',

            // Tỷ lệ cướp bóng
            7: 'ボール奪取率',

            // Tỷ lệ clear thành công
            8: 'クリア成功率',

            // Tỷ lệ thu hồi bóng hai thành công
            9: 'セカンドボール回収率',

            // Tỷ lệ save sút bóng
            10: 'シュートセーブ率',

            // Tỷ lệ bắt bóng cross
            11: 'クロスキャッチ率',

            // Tỷ lệ ghi bàn Set play
            12: 'セットプレー得点率',

            // Số lần ném biên thành công
            13: 'スローイン成功率',

            // Tỷ lệ mất điểm
            14: '失点率',
        },
    },
}

const BOX_SCORE_TABS = {
    PERSONAL_STATS: {
        id: 1,
        title: '個人スタッツ'
    },
    TEAM_STATS: {
        id: 2,
        title: 'チームスタッツ'
    },
};

const ACTION_MAP = {
    VALUES: {
        KICK: {//Sút bóng,
            id: 1,
            title: 'シュート',
            title_vi: 'Sút bóng',
            type: ['player', 'goalkeeper'],
            flow: 'attack',
        },
        PASS: {//Truyền bóng,
            id: 2,
            title: 'ドリブル',
            title_vi: 'Truyền bóng',
            type: ['player', 'goalkeeper'],
            flow: 'attack',
        },
        CROSS: {//Cross (tạt bóng)',
            id: 3,
            title: 'クロス',
            title_vi: 'tạt bóng',
            type: ['player', 'goalkeeper'],
            flow: 'attack',
        },
        INFILTRATE_PA: {//xâm nhập PA',
            id: 4,
            title: 'PA侵入',
            title_vi: 'Xâm nhập PA',
            type: ['player', 'goalkeeper'],
            flow: 'attack',
        },
        INFILTRATE_LINE_30M: {//xâm nhập line 30m',
            id: 5,
            title: '30mライン侵入',
            title_vi: 'xâm nhập line 30m',
            type: ['player', 'goalkeeper'],
            flow: 'attack',
        },
        CLEAR: {//Clear (Tranh chấp bóng trong vùng cấm địa)',
            id: 6,
            title: 'クリア',
            title_vi: 'Clear',
            type: ['player', 'goalkeeper'],
            flow: 'defense',
        },
        TACKLE: {//Tắc bóng',
            id: 7,
            title: 'タックル',
            title_vi: 'Tắc bóng',
            type: ['player', 'goalkeeper'],
            flow: 'defense',
        },
        BLOCK: {//block,
            id: 8,
            title: 'ブロック',
            title_vi: 'block',
            type: ['player', 'goalkeeper'],
            flow: 'defense',
        },
        INTERCEPT: {//Chặn bóng',
            id: 9,
            title: 'インターセプト',
            title_vi: 'Chặn bóng',
            type: ['player', 'goalkeeper'],
            flow: 'defense',
        },
        CATCHING: {//Bắt bóng',
            id: 10,
            title: 'キャッチング',
            title_vi: 'Bắt bóng',
            type: ['goalkeeper'],
            flow: 'gk',
        },
        PUNCHING: {//Đấm bóng',
            id: 11,
            title: 'パンチング',
            title_vi: 'Đấm bóng',
            type: ['goalkeeper'],
            flow: 'gk',
        },
        PUNT_KICK: {//Punt kick',
            id: 12,
            title: 'パントキック',
            title_vi: 'Punt kick',
            type: ['goalkeeper'],
            flow: 'gk',
        },
        THROW_BALL: {//nem bong',
            id: 13,
            title: 'スローイング',
            title_vi: 'Throw ball',
            type: ['goalkeeper'],
            flow: 'gk',
        },
        TACKLE_OVERHEAD: {//Tranh bóng trên không,
            id: 14,
            title: '空中戦',
            title_vi: 'Tranh bóng trên không',
            type: ['foot_button'],
        },
        SECOND_BALL: {//Bóng hai',
            id: 15,
            title: 'セカンドボール',
            title_vi: 'Bóng hai',
            type: ['foot_button'],
        },
        DOMINANCE: {//Ưu thế',
            id: 16,
            title: 'アドバンテージ',
            title_vi: 'Ưu thế',
            type: []
        },
        OFFENSE: {//Phạm luật',
            id: 17,
            title: 'ファウル',
            title_vi: 'Phạm luật',
            type: []
        },
        RESTART: {//Restart',
            id: 18,
            title: '再開',
            title_vi: 'Restart',
            type: [],
        },
        OUT_OF_GOAL_LINE : {//Ra ngoài vạch gôn',
            id: 19,
            title: 'ゴールラインアウト',
            title_vi: 'Ra ngoài vạch gôn',
            type: [],
        },
        BEYOND_BORDER: {//Ra ngoài đường biên',
            id: 20,
            title: 'タッチラインアウト',
            title_vi: 'Ra ngoài đường biên',
            type: [],
        },
        REFEREE_PAUSE: {//Trọng tài chính cho tạm dừng
            id: 22,
            title: '主審による停止',
            title_vi: 'Trọng tài chính cho tạm dừng',
            type: [],
        },
        NO_ACTION: {//Không làm gì cả
            id: 23,
            title: 'なし',
            title_vi: 'không làm gì cả',
            type: ['subKick'],
        },
        SAVING: {//saving
            id: 24,
            title: 'セービング',
            title_vi: 'saving',
            type: ['subKick'],
        },
        FUMBLE: {//fumble
            id: 25,
            title: 'ファンブル',
            title_vi: 'fumble',
            type: ['subKick'],
        },
        // Automatic action detection
        ASSIST: {// Assist
            id: 26,
            title: 'アシスト',
            title_vi: 'Kiến tạo',
            type: [],
        },
        SECOND_ASSIST: {// Second assist
            id: 27,
            title: 'アシスト前パス',
            title_vi: 'Tiền kiến tạo',
            type: [],
        },
        KEY_PASS: {// Key pass
            id: 28,
            title: 'キーパス',
            title_vi: 'Chìa khóa',
            type: [],
        },
        BALL_CUTTING: {
            id: 29,
            title: 'カット',
            title_vi: 'Cắt bóng',
            type: [],
        },
        OUT_OF_PLAY: {
            id: 30,
            title: 'アウトオブプレー',
            title_vi: '',
            type: ['foot_button'],
        },
        FOUL: {
            id: 31,
            title: 'ファウル',
            title_vi: 'Phạm luật',
            type: ['menu_outofplay'],
        },
        CORNER_KICK: {
            id: 32,
            title: 'コーナーキック',
            title_vi: 'Đá phạt góc',
            type: ['menu_outofplay'],
        },
        GOAL_KICK: {
            id: 33,
            title: 'ゴールキック',
            title_vi: 'Đá phạt gôn',
            type: ['menu_outofplay'],
        },
        THROW_FROM_THE_SIDE: {
            id: 34,
            title: 'スローイン',
            title_vi: 'Ném biên',
            type: ['menu_outofplay'],
        },
        OFFSIDE: {
            id: 35,
            title: 'オフサイド',
            title_vi: 'Việt vị',
            type: ['menu_outofplay'],
        },
        CHANGE_MEMBER: {
            id: 36,
            title: '選手交代(IN)',
            title_vi: 'Thay cầu thủ vô sân',
            type: [],
        },
        EARLY_CROSS: {
            id: 37,
            title: 'アーリークロス',
            title_vi: 'Early cross',
            type: [],
        },
        FOULED: {
            id: 38,
            title: '被ファウル',
            title_vi: 'Bị phạm lỗi',
            type: [],
        },
        END_OF_MATCH: {
            id: 39,
            title: '試合終了',
            title_vi: 'Kết thúc trận đấu',
            type: [],
        },
        PENALTIES_KICK: {
            id: 40,
            title: 'PK',
            title_vi: 'Đá luân lưu',
            type: [],
        },
        CHANGE_MEMBER_IN: {
            id: 41,
            title: '選手交代(IN)',
            title_vi: 'Thay cầu thủ vô sân',
            type: [],
        },
        CHANGE_MEMBER_OUT: {
            id: 42,
            title: '選手交代(OUT)',
            title_vi: 'Thay cầu thủ ra sân',
            type: [],
        },
        CHANGE_ROUND: {
            id: 43,
            title: '終了',
            title_vi: 'Chấm dứt',
            type: [],
        },
        DIRECT_FREE_KICK: {
            id: 44,
            title: '直接FK',
            title_vi: 'Đá phạt trực tiếp',
            type: [],
        },
        INDIRECT_FREE_KICK: {
            id: 45,
            title: '間接FK',
            title_vi: 'Đá phạt gián tiếp',
            type: [],
        },
        PK_FREE_KICK: {
            id: 46,
            title: 'PKフリーキック',
            title_vi: 'Đá penalty',
            type: [],
        },
        UNKNOWN_1ST: {
            id: 47,
            title: '?',
            title_vi: '? 1st',
            type: [],
        },
        FREE_KICK: {
            id: 48,
            title: 'フリーキック',
            title_vi: 'free kick',
            type: [],
        },
        CHANGE_DMF: {
            id: 49,
            title: 'フォーメーション変更',
            title_vi: 'Thay đổi đội hình',
            type: [],
        },
        GK_ACTION_LEFT: {
            id: 50,
            title: '左',
            title_vi: 'Trái',
            type: [],
        },
        GK_ACTION_CENTER: {
            id: 51,
            title: '中央',
            title_vi: 'Chính giữa',
            type: [],
        },
        GK_ACTION_RIGHT: {
            id: 52,
            title: '右',
            title_vi: 'Phải',
            type: [],
        },
        GK_ACTION_STOP: {
            id: 53,
            title: 'ストップ',
            title_vi: 'Stop',
            type: [],
        },
        OFFSIDE_TRAP: {
            id: 54,
            title: 'オフサイド',
            title_vi: 'Bẫy việt vị',
            type: [],
        },
    },
};

const goalConfig = {
  goalNumbers: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15],

  forbiddenZones: ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'],

  numbers_outer_goal: {
    left: 16,
    topLeft: 17,
    topRight: 18,
    right: 19,
  },

  number_border_goal: {
    left: 20,
    top: 21,
    right: 22,
  },
};

const kickSituation = {
    title: 'シュート状況',
    value: {
        set_play_direct: {
            id: 1,
            title: 'セットプレー直接',
        },
        kick_from_set_play: {
            id: 2,
            title: 'セットプレーから',
        },
        cross: {
            id: 3,
            title: 'クロスから',
        },
        through_pass: {
            id: 4,
            title: 'スルーパスから',
        },
        short_pass: {
            id: 5,
            title: 'ショートパスから',
        },
        long_pass: {
            id: 6,
            title: 'ロングパスから',
        },
        pass: {
            id: 7,
            title: 'ドリブルから',
        },
        overflow: {
            id: 8,
            title: 'こぼれ球から',
        },
        short_counter: {
            id: 9,
            title: 'ショートカウンター',
        },
        other: {
            id: 10,
            title: 'その他',
        },
    },
};

const gkActions = {
    title: 'GKアクション',
    value: {
        no: {
            id: 1,
            title: 'なし',
        },
        saving: {
            id: 2,
            title: 'セービング',
        },
        punch_ball: {
            id: 3,
            title: 'パンチング',
        },
        catch_ball: {
            id: 4,
            title: 'キャッチング',
        },
        punt_kick: {
            id: 5,
            title: 'ファンブル',
        },
    },
};

export {
    BOX_SCORE_PERSONAL_COLUMN_NAME,
    BOX_SCORE_TEAM_COLUMN_NAME,
    BOX_SCORE_TABS,
    BOX_SCORE_TYPES,
    ACTION_MAP,
    goalConfig,
    kickSituation,
    gkActions
}
