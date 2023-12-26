<?php
//functions.phpを読み込む
require_once("functions.php");

//入力データ取得
$task = (string)filter_input(INPUT_POST,'task');

//空文字の場合エラーメッセージ
if($task === '')
{
    redirect_with_message('todo_list.php', MESSAGE_TASK_EMPTY);
}
//文字数オーバーの場合エラーメッセージ
if(mb_strlen($task) > 140)
{
    redirect_with_message('todo_list.php', MESSAGE_TASK_MAX_LENGTH);
}

//ファイルの排他ロックを取得
$lock_handle = lock_file(LOCK_SH);

//新規id取得
$id = get_new_todo_id();
//時間取得
$date = date('y-m-d H:i:s');
//登録するタスクのステータスのためSTATUS_OPENED
$status = STATUS_OPENED;

//登録する要素を配列に代入
$todo = [$id, $task, $date, $status];

//Todo追加
add_todo_list($todo);

//排他ロックを解除
unlock_file($lock_handle);

//todo_list.phpにリダイレクト
redirect('todo_list.php');

?>