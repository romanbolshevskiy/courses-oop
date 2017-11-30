<?php

 	include_once ROOT. '/models/User.php'; // підключення моделі
  include_once ROOT. '/models/Chat.php'; // підключення моделі

	class ChatController {

    //SSE1
    public function actionChatUpdate() {
        
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');

        $count = Chat::count_messages();
        $x = 'dfg';

        echo "retry: 2000\n"; //час відправки повідомлення
        echo "data: " . $count . "\n\n";
        flush();
    }

    //SSE2
    public function actionGetChatMessages() {
      $messages = Chat::all_messages();
      echo json_encode($messages,JSON_UNESCAPED_UNICODE);
      return true;
    }

     //SSE3
  	public function actionIndex() {

      if($_SESSION['user']){
        $user= User::getUserById($_SESSION['user']);
        $user = $user['name'];// . " ". $user['name'];
      }
      else{
        header("Location: /");
      }

      $name = substr($_POST['name'], 0, 200); // обрезаем до 200 символов
      $name = htmlspecialchars($name); // заменяем опасные теги (<h1>,<br>, и прочие) на безопасные
      $text = substr($_POST['text'], 0, 200); // обрезаем до 200 символов
      $text = htmlspecialchars($text); // заменяем опасные теги (<h1>,<br>, и прочие) на безопасные
      
      // добавляем новую запись в таблицу messages
      if($name){
          Chat::send_messages($name,$text);      
      }
      $messages = Chat::all_messages();

      require_once(ROOT . '/views/chat/index.php');
      return true;
  	}

	}