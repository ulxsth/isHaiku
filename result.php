<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>結果</title>
</head>
<body>
    <a href="index.php">戻る</a><br>
    <?php
    $haiku = $_POST['haiku'];
    $haiku = mb_convert_kana($haiku, 's');

    // 入力された文字列はひらがな、カタカナのいずれかであり、文節にスペースを挟む
    // 指定した文字以外がある場合はエラーを表示する
    if (preg_match('/[^ぁ-んァ-ン 　]/u', $haiku)) {
        echo '<p>ひらがな、カタカナ、スペース以外の文字が含まれています</p>';
        exit;
    }

    // 空白以外の文字を「あ」に変換する
    $formatted_haiku = preg_replace('/[^ 　]/u', 'あ', $haiku);

    echo $haiku;

    // スペースで区切られた文字列が5文字、7文字、5文字の順に並んでいるかを表示する
    // スペースは文字数に含まない
    $haiku_array = explode(' ', $formatted_haiku);
    if (count($haiku_array) === 3
        && mb_strlen($haiku_array[0]) === 5
        && mb_strlen($haiku_array[1]) === 7
        && mb_strlen($haiku_array[2]) === 5) {
        echo '<p>5-7-5に則った、素晴らしい俳句です</p>';
        exit;

    // いずれかの文字列が指定の文字数より1文字足りない場合は「字足らず」
    // 一文字多い場合は「字あまり」とする
    } else if (count($haiku_array) === 3
        || mb_strlen($haiku_array[0]) === 4
        || mb_strlen($haiku_array[1]) === 6
        || mb_strlen($haiku_array[2]) === 4) {
        echo '<p>字足らずです</p>';
        exit;
    } else if (count($haiku_array) === 3
        || mb_strlen($haiku_array[0]) === 8
        || mb_strlen($haiku_array[1]) === 10
        || mb_strlen($haiku_array[2]) === 8) {
        echo '<p>字あまりです</p>';
        exit;
    }

    echo '<p>正しくない形式です</p>';
    ?>
</body>
</html>
