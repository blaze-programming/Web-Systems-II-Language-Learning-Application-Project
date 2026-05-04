CREATE TABLE kana (
    id INT AUTO_INCREMENT PRIMARY KEY,
    romaji VARCHAR(4),
    hiragana VARCHAR(3),
    katakana VARCHAR(3),
    type VARCHAR(50),
    related_to INT,
    FOREIGN KEY (related_to) REFERENCES kana(id) ON DELETE SET NULL
);

CREATE TABLE listening_exercise (
    id INT AUTO_INCREMENT PRIMARY KEY,
    english_translation TEXT,
    difficulty INT
);

CREATE TABLE listening_words (
    id INT AUTO_INCREMENT PRIMARY KEY,
    listening_id_fk INT,
    word_position INT,
    english VARCHAR(100),
    kanji VARCHAR(100),
    furigana VARCHAR(100),
    romaji VARCHAR(100),
    FOREIGN KEY (listening_id_fk) REFERENCES listening_exercise(id) ON DELETE CASCADE
);

CREATE TABLE user_kana_progress (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_fk INT,
    kana_fk INT,
    last_time_encountered DATETIME,
    progress DECIMAL(5,2),
    FOREIGN KEY (user_fk) REFERENCES phpauth_users(id) ON DELETE CASCADE,
    FOREIGN KEY (kana_fk) REFERENCES kana(id) ON DELETE CASCADE
);

CREATE TABLE user_listening_progress (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_fk INT,
    listening_exercise_fk INT,
	kana_type ENUM('hiragana', 'katakana') DEFAULT 'hiragana'
    last_time_encountered DATETIME,
    progress DECIMAL(5,2),
    FOREIGN KEY (user_fk) REFERENCES phpauth_users(id) ON DELETE CASCADE,
    FOREIGN KEY (listening_exercise_fk) REFERENCES listening_exercise(id) ON DELETE CASCADE
);

-- Basic kana
INSERT INTO kana (romaji, hiragana, katakana, type, related_to) VALUES
('a','あ','ア','basic',NULL),
('i','い','イ','basic',NULL),
('u','う','ウ','basic',NULL),
('e','え','エ','basic',NULL),
('o','お','オ','basic',NULL),

('ka','か','カ','basic',NULL),
('ki','き','キ','basic',NULL),
('ku','く','ク','basic',NULL),
('ke','け','ケ','basic',NULL),
('ko','こ','コ','basic',NULL),

('sa','さ','サ','basic',NULL),
('shi','し','シ','basic',NULL),
('su','す','ス','basic',NULL),
('se','せ','セ','basic',NULL),
('so','そ','ソ','basic',NULL),

('ta','た','タ','basic',NULL),
('chi','ち','チ','basic',NULL),
('tsu','つ','ツ','basic',NULL),
('te','て','テ','basic',NULL),
('to','と','ト','basic',NULL),

('na','な','ナ','basic',NULL),
('ni','に','ニ','basic',NULL),
('nu','ぬ','ヌ','basic',NULL),
('ne','ね','ネ','basic',NULL),
('no','の','ノ','basic',NULL),

('ha','は','ハ','basic',NULL),
('hi','ひ','ヒ','basic',NULL),
('fu','ふ','フ','basic',NULL),
('he','へ','ヘ','basic',NULL),
('ho','ほ','ホ','basic',NULL),

('ma','ま','マ','basic',NULL),
('mi','み','ミ','basic',NULL),
('mu','む','ム','basic',NULL),
('me','め','メ','basic',NULL),
('mo','も','モ','basic',NULL),

('ya','や','ヤ','basic',NULL),
('yu','ゆ','ユ','basic',NULL),
('yo','よ','ヨ','basic',NULL),

('ra','ら','ラ','basic',NULL),
('ri','り','リ','basic',NULL),
('ru','る','ル','basic',NULL),
('re','れ','レ','basic',NULL),
('ro','ろ','ロ','basic',NULL),

('wa','わ','ワ','basic',NULL),
('wo','を','ヲ','basic',NULL),
('n','ん','ン','basic',NULL);

-- Dakuten and handakuten kana
-- related_to points to the base kana
INSERT INTO kana (romaji, hiragana, katakana, type, related_to) VALUES
('ga','が','ガ','dakuten',(SELECT id FROM kana k WHERE k.romaji = 'ka')),
('gi','ぎ','ギ','dakuten',(SELECT id FROM kana k WHERE k.romaji = 'ki')),
('gu','ぐ','グ','dakuten',(SELECT id FROM kana k WHERE k.romaji = 'ku')),
('ge','げ','ゲ','dakuten',(SELECT id FROM kana k WHERE k.romaji = 'ke')),
('go','ご','ゴ','dakuten',(SELECT id FROM kana k WHERE k.romaji = 'ko')),

('za','ざ','ザ','dakuten',(SELECT id FROM kana k WHERE k.romaji = 'sa')),
('ji','じ','ジ','dakuten',(SELECT id FROM kana k WHERE k.romaji = 'shi')),
('zu','ず','ズ','dakuten',(SELECT id FROM kana k WHERE k.romaji = 'su')),
('ze','ぜ','ゼ','dakuten',(SELECT id FROM kana k WHERE k.romaji = 'se')),
('zo','ぞ','ゾ','dakuten',(SELECT id FROM kana k WHERE k.romaji = 'so')),

('da','だ','ダ','dakuten',(SELECT id FROM kana k WHERE k.romaji = 'ta')),
('di','ぢ','ヂ','dakuten',(SELECT id FROM kana k WHERE k.romaji = 'chi')),
('du','づ','ヅ','dakuten',(SELECT id FROM kana k WHERE k.romaji = 'tsu')),
('de','で','デ','dakuten',(SELECT id FROM kana k WHERE k.romaji = 'te')),
('do','ど','ド','dakuten',(SELECT id FROM kana k WHERE k.romaji = 'to')),

('ba','ば','バ','dakuten',(SELECT id FROM kana k WHERE k.romaji = 'ha')),
('bi','び','ビ','dakuten',(SELECT id FROM kana k WHERE k.romaji = 'hi')),
('bu','ぶ','ブ','dakuten',(SELECT id FROM kana k WHERE k.romaji = 'fu')),
('be','べ','ベ','dakuten',(SELECT id FROM kana k WHERE k.romaji = 'he')),
('bo','ぼ','ボ','dakuten',(SELECT id FROM kana k WHERE k.romaji = 'ho')),

('pa','ぱ','パ','handakuten',(SELECT id FROM kana k WHERE k.romaji = 'ha')),
('pi','ぴ','ピ','handakuten',(SELECT id FROM kana k WHERE k.romaji = 'hi')),
('pu','ぷ','プ','handakuten',(SELECT id FROM kana k WHERE k.romaji = 'fu')),
('pe','ぺ','ペ','handakuten',(SELECT id FROM kana k WHERE k.romaji = 'he')),
('po','ぽ','ポ','handakuten',(SELECT id FROM kana k WHERE k.romaji = 'ho'));

-- Combination kana
-- related_to points to the main kana used in the combo
INSERT INTO kana (romaji, hiragana, katakana, type, related_to) VALUES
('kya','きゃ','キャ','combo',(SELECT id FROM kana k WHERE k.romaji = 'ki')),
('kyu','きゅ','キュ','combo',(SELECT id FROM kana k WHERE k.romaji = 'ki')),
('kyo','きょ','キョ','combo',(SELECT id FROM kana k WHERE k.romaji = 'ki')),

('sha','しゃ','シャ','combo',(SELECT id FROM kana k WHERE k.romaji = 'shi')),
('shu','しゅ','シュ','combo',(SELECT id FROM kana k WHERE k.romaji = 'shi')),
('sho','しょ','ショ','combo',(SELECT id FROM kana k WHERE k.romaji = 'shi')),

('cha','ちゃ','チャ','combo',(SELECT id FROM kana k WHERE k.romaji = 'chi')),
('chu','ちゅ','チュ','combo',(SELECT id FROM kana k WHERE k.romaji = 'chi')),
('cho','ちょ','チョ','combo',(SELECT id FROM kana k WHERE k.romaji = 'chi')),

('nya','にゃ','ニャ','combo',(SELECT id FROM kana k WHERE k.romaji = 'ni')),
('nyu','にゅ','ニュ','combo',(SELECT id FROM kana k WHERE k.romaji = 'ni')),
('nyo','にょ','ニョ','combo',(SELECT id FROM kana k WHERE k.romaji = 'ni')),

('hya','ひゃ','ヒャ','combo',(SELECT id FROM kana k WHERE k.romaji = 'hi')),
('hyu','ひゅ','ヒュ','combo',(SELECT id FROM kana k WHERE k.romaji = 'hi')),
('hyo','ひょ','ヒョ','combo',(SELECT id FROM kana k WHERE k.romaji = 'hi')),

('mya','みゃ','ミャ','combo',(SELECT id FROM kana k WHERE k.romaji = 'mi')),
('myu','みゅ','ミュ','combo',(SELECT id FROM kana k WHERE k.romaji = 'mi')),
('myo','みょ','ミョ','combo',(SELECT id FROM kana k WHERE k.romaji = 'mi')),

('rya','りゃ','リャ','combo',(SELECT id FROM kana k WHERE k.romaji = 'ri')),
('ryu','りゅ','リュ','combo',(SELECT id FROM kana k WHERE k.romaji = 'ri')),
('ryo','りょ','リョ','combo',(SELECT id FROM kana k WHERE k.romaji = 'ri')),

('gya','ぎゃ','ギャ','combo',(SELECT id FROM kana k WHERE k.romaji = 'gi')),
('gyu','ぎゅ','ギュ','combo',(SELECT id FROM kana k WHERE k.romaji = 'gi')),
('gyo','ぎょ','ギョ','combo',(SELECT id FROM kana k WHERE k.romaji = 'gi')),

('ja','じゃ','ジャ','combo',(SELECT id FROM kana k WHERE k.romaji = 'ji')),
('ju','じゅ','ジュ','combo',(SELECT id FROM kana k WHERE k.romaji = 'ji')),
('jo','じょ','ジョ','combo',(SELECT id FROM kana k WHERE k.romaji = 'ji')),

('bya','びゃ','ビャ','combo',(SELECT id FROM kana k WHERE k.romaji = 'bi')),
('byu','びゅ','ビュ','combo',(SELECT id FROM kana k WHERE k.romaji = 'bi')),
('byo','びょ','ビョ','combo',(SELECT id FROM kana k WHERE k.romaji = 'bi')),

('pya','ぴゃ','ピャ','combo',(SELECT id FROM kana k WHERE k.romaji = 'pi')),
('pyu','ぴゅ','ピュ','combo',(SELECT id FROM kana k WHERE k.romaji = 'pi')),
('pyo','ぴょ','ピョ','combo',(SELECT id FROM kana k WHERE k.romaji = 'pi'));

-- Exercise 1
INSERT INTO listening_exercise (english_translation, difficulty)
VALUES ('Hello. My name is Tanaka.', 5);

INSERT INTO listening_words (listening_id_fk, word_position, kanji, furigana, romaji, english) VALUES
(LAST_INSERT_ID(), 1, NULL, 'こんにちは', 'konnichiwa', 'hello'),
(LAST_INSERT_ID(), 2, '私', 'わたし', 'watashi', 'I / me'),
(LAST_INSERT_ID(), 3, NULL, 'は', 'wa', 'topic marker'),
(LAST_INSERT_ID(), 4, '田中', 'たなか', 'Tanaka', 'Tanaka'),
(LAST_INSERT_ID(), 5, NULL, 'です', 'desu', 'am / is');

-- Exercise 2
INSERT INTO listening_exercise (english_translation, difficulty)
VALUES ('Good morning. How are you?', 8);

SET @exercise_id = LAST_INSERT_ID();

INSERT INTO listening_words (listening_id_fk, word_position, kanji, furigana, romaji, english) VALUES
(@exercise_id, 1, NULL, 'おはよう', 'ohayou', 'good morning'),
(@exercise_id, 2, NULL, 'ございます', 'gozaimasu', 'polite expression'),
(@exercise_id, 3, '元気', 'げんき', 'genki', 'well / healthy'),
(@exercise_id, 4, NULL, 'です', 'desu', 'are / is'),
(@exercise_id, 5, NULL, 'か', 'ka', 'question marker');

-- Exercise 3
INSERT INTO listening_exercise (english_translation, difficulty)
VALUES ('I eat rice.', 10);

SET @exercise_id = LAST_INSERT_ID();

INSERT INTO listening_words (listening_id_fk, word_position, kanji, furigana, romaji, english) VALUES
(@exercise_id, 1, '私', 'わたし', 'watashi', 'I / me'),
(@exercise_id, 2, NULL, 'は', 'wa', 'topic marker'),
(@exercise_id, 3, 'ご飯', 'ごはん', 'gohan', 'rice / meal'),
(@exercise_id, 4, NULL, 'を', 'o', 'object marker'),
(@exercise_id, 5, '食べます', 'たべます', 'tabemasu', 'eat');

-- Exercise 4
INSERT INTO listening_exercise (english_translation, difficulty)
VALUES ('I drink water.', 10);

SET @exercise_id = LAST_INSERT_ID();

INSERT INTO listening_words (listening_id_fk, word_position, kanji, furigana, romaji, english) VALUES
(@exercise_id, 1, '私', 'わたし', 'watashi', 'I / me'),
(@exercise_id, 2, NULL, 'は', 'wa', 'topic marker'),
(@exercise_id, 3, '水', 'みず', 'mizu', 'water'),
(@exercise_id, 4, NULL, 'を', 'o', 'object marker'),
(@exercise_id, 5, '飲みます', 'のみます', 'nomimasu', 'drink');

-- Exercise 5
INSERT INTO listening_exercise (english_translation, difficulty)
VALUES ('I go to school.', 15);

SET @exercise_id = LAST_INSERT_ID();

INSERT INTO listening_words (listening_id_fk, word_position, kanji, furigana, romaji, english) VALUES
(@exercise_id, 1, '私', 'わたし', 'watashi', 'I / me'),
(@exercise_id, 2, NULL, 'は', 'wa', 'topic marker'),
(@exercise_id, 3, '学校', 'がっこう', 'gakkou', 'school'),
(@exercise_id, 4, NULL, 'に', 'ni', 'to / toward'),
(@exercise_id, 5, '行きます', 'いきます', 'ikimasu', 'go');

-- Exercise 6
INSERT INTO listening_exercise (english_translation, difficulty)
VALUES ('I read a book.', 18);

SET @exercise_id = LAST_INSERT_ID();

INSERT INTO listening_words (listening_id_fk, word_position, kanji, furigana, romaji, english) VALUES
(@exercise_id, 1, '私', 'わたし', 'watashi', 'I / me'),
(@exercise_id, 2, NULL, 'は', 'wa', 'topic marker'),
(@exercise_id, 3, '本', 'ほん', 'hon', 'book'),
(@exercise_id, 4, NULL, 'を', 'o', 'object marker'),
(@exercise_id, 5, '読みます', 'よみます', 'yomimasu', 'read');

-- Exercise 7
INSERT INTO listening_exercise (english_translation, difficulty)
VALUES ('This is a dog.', 12);

SET @exercise_id = LAST_INSERT_ID();

INSERT INTO listening_words (listening_id_fk, word_position, kanji, furigana, romaji, english) VALUES
(@exercise_id, 1, NULL, 'これ', 'kore', 'this'),
(@exercise_id, 2, NULL, 'は', 'wa', 'topic marker'),
(@exercise_id, 3, '犬', 'いぬ', 'inu', 'dog'),
(@exercise_id, 4, NULL, 'です', 'desu', 'is');

-- Exercise 8
INSERT INTO listening_exercise (english_translation, difficulty)
VALUES ('That is a cat.', 12);

SET @exercise_id = LAST_INSERT_ID();

INSERT INTO listening_words (listening_id_fk, word_position, kanji, furigana, romaji, english) VALUES
(@exercise_id, 1, NULL, 'それ', 'sore', 'that'),
(@exercise_id, 2, NULL, 'は', 'wa', 'topic marker'),
(@exercise_id, 3, '猫', 'ねこ', 'neko', 'cat'),
(@exercise_id, 4, NULL, 'です', 'desu', 'is');

-- Exercise 9
INSERT INTO listening_exercise (english_translation, difficulty)
VALUES ('Today is hot.', 20);

SET @exercise_id = LAST_INSERT_ID();

INSERT INTO listening_words (listening_id_fk, word_position, kanji, furigana, romaji, english) VALUES
(@exercise_id, 1, '今日', 'きょう', 'kyou', 'today'),
(@exercise_id, 2, NULL, 'は', 'wa', 'topic marker'),
(@exercise_id, 3, '暑い', 'あつい', 'atsui', 'hot'),
(@exercise_id, 4, NULL, 'です', 'desu', 'is');

-- Exercise 10
INSERT INTO listening_exercise (english_translation, difficulty)
VALUES ('Tomorrow will be busy.', 25);

SET @exercise_id = LAST_INSERT_ID();

INSERT INTO listening_words (listening_id_fk, word_position, kanji, furigana, romaji, english) VALUES
(@exercise_id, 1, '明日', 'あした', 'ashita', 'tomorrow'),
(@exercise_id, 2, NULL, 'は', 'wa', 'topic marker'),
(@exercise_id, 3, '忙しい', 'いそがしい', 'isogashii', 'busy'),
(@exercise_id, 4, NULL, 'です', 'desu', 'is');

-- Exercise 11
INSERT INTO listening_exercise (english_translation, difficulty)
VALUES ('Where is the station?', 30);

SET @exercise_id = LAST_INSERT_ID();

INSERT INTO listening_words (listening_id_fk, word_position, kanji, furigana, romaji, english) VALUES
(@exercise_id, 1, '駅', 'えき', 'eki', 'station'),
(@exercise_id, 2, NULL, 'は', 'wa', 'topic marker'),
(@exercise_id, 3, NULL, 'どこ', 'doko', 'where'),
(@exercise_id, 4, NULL, 'です', 'desu', 'is'),
(@exercise_id, 5, NULL, 'か', 'ka', 'question marker');

-- Exercise 12
INSERT INTO listening_exercise (english_translation, difficulty)
VALUES ('I buy coffee at the store.', 35);

SET @exercise_id = LAST_INSERT_ID();

INSERT INTO listening_words (listening_id_fk, word_position, kanji, furigana, romaji, english) VALUES
(@exercise_id, 1, '店', 'みせ', 'mise', 'store'),
(@exercise_id, 2, NULL, 'で', 'de', 'at / by means of'),
(@exercise_id, 3, NULL, 'コーヒー', 'koohii', 'coffee'),
(@exercise_id, 4, NULL, 'を', 'o', 'object marker'),
(@exercise_id, 5, '買います', 'かいます', 'kaimasu', 'buy');

-- Exercise 13
INSERT INTO listening_exercise (english_translation, difficulty)
VALUES ('My friend comes to my house.', 40);

SET @exercise_id = LAST_INSERT_ID();

INSERT INTO listening_words (listening_id_fk, word_position, kanji, furigana, romaji, english) VALUES
(@exercise_id, 1, '友達', 'ともだち', 'tomodachi', 'friend'),
(@exercise_id, 2, NULL, 'が', 'ga', 'subject marker'),
(@exercise_id, 3, '家', 'いえ', 'ie', 'house / home'),
(@exercise_id, 4, NULL, 'に', 'ni', 'to'),
(@exercise_id, 5, '来ます', 'きます', 'kimasu', 'comes');

-- Exercise 14
INSERT INTO listening_exercise (english_translation, difficulty)
VALUES ('I like Japanese.', 38);

SET @exercise_id = LAST_INSERT_ID();

INSERT INTO listening_words (listening_id_fk, word_position, kanji, furigana, romaji, english) VALUES
(@exercise_id, 1, '私', 'わたし', 'watashi', 'I / me'),
(@exercise_id, 2, NULL, 'は', 'wa', 'topic marker'),
(@exercise_id, 3, '日本語', 'にほんご', 'nihongo', 'Japanese language'),
(@exercise_id, 4, NULL, 'が', 'ga', 'subject marker'),
(@exercise_id, 5, '好き', 'すき', 'suki', 'like'),
(@exercise_id, 6, NULL, 'です', 'desu', 'is');

-- Exercise 15
INSERT INTO listening_exercise (english_translation, difficulty)
VALUES ('I study Japanese every day.', 45);

SET @exercise_id = LAST_INSERT_ID();

INSERT INTO listening_words (listening_id_fk, word_position, kanji, furigana, romaji, english) VALUES
(@exercise_id, 1, '毎日', 'まいにち', 'mainichi', 'every day'),
(@exercise_id, 2, '日本語', 'にほんご', 'nihongo', 'Japanese language'),
(@exercise_id, 3, NULL, 'を', 'o', 'object marker'),
(@exercise_id, 4, '勉強します', 'べんきょうします', 'benkyou shimasu', 'study');
