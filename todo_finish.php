<?php
//functions.phpを読み込む
require_once('functions.php');

//画面から送信したidを取得
$id = (int)filter_input(INPUT_GET,'id', FILTER_VALIDATE_INT);
//idが0以下の場合エラーメッセージ
if($id <= 0)
{
    redirect_with_message('todo_list.php', MESSAGE_ID_INVALID);
}

//ファイルの排他ロックを取得
$lock_handle = lock_file();

//TodoListを取得
$todo_list = read_todo_list();

//TodoListから一致するidを取得
//リファレンス関数で&を付けることで参照データをコピーできる
foreach($todo_list as &$todo)
{
    //idは0番目
    if((int)$todo[0] === $id)
    {
        //ステータスは3番目、完了にする
        $todo[3] = STATUS_CLOSED;
        //breakで終了する
        break;
    }
}
//更新処理
write_todo_list($todo_list);

//排他ロックを解除
unlock_file($lock_handle);

//todo_list.phpにリダイレクト
redirect('todo_list.php');
?>