<?php

require_once 'src/autoload.php';

use Mess\Http\Header;
use Mess\Http\Requests\ConversationRequest;
use Mess\Http\Requests\UserIdRequest;
use Mess\Persistence\ConnectionString;
use Mess\Persistence\CredentialsFile;
use Mess\Persistence\Database\Message\MessageReactionRepository;
use Mess\Persistence\Database\Message\MessageRepository;
use Mess\Persistence\Session\Session;
use Mess\View\Result;
use Mess\View\View;
use Mess\View\Views\ConversationView;

$session = new Session();

if ($session->userLoggedIn()) {
    $string = new ConnectionString(new CredentialsFile("connection.txt"));

    function getView(ConversationRequest       $conversationRequest,
                     MessageReactionRepository $messageReaction,
                     MessageRepository         $messageRepository,
                     Session                   $session): View
    {
        $messages = $messageRepository->messages($session->userId(), $conversationRequest->userId());
        if (!$conversationRequest->wantsSubmit()) {
            return new ConversationView($session->userId(), $messages, Result::success());
        }
        if ($conversationRequest->message() === '') {
            return new ConversationView($session->userId(), $messages, Result::failure('Puste pole'));
        }
        if (!preg_match('/^[a-zA-Z-0-9ąćęłńóśźż?,._\-\s]{1,400}$/', $conversationRequest->Message())) {
            return new ConversationView($session->userId(), $messages, Result::failure('Niedozwolone znaki, lub za długi tekst'));
        }
        $messageReaction->addMessage($session->userId(), $conversationRequest->userId(), $conversationRequest->message());
        return new ConversationView($session->userId(), $messages, Result::success());
    }

    $view = getView(new ConversationRequest($_POST, new UserIdRequest($_GET)),
        new MessageReactionRepository($string->getPdo()),
        new MessageRepository($string->getPdo()),
        $session);
    $view->render();
} else {
    $header = Header::homepage();
    $header->send();
}
