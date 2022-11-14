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
use Mess\View\Validation;
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
        if ($conversationRequest->wantsSubmit()) {
            if ($conversationRequest->message() === '') {
                return new ConversationView($session->userId(), $messageRepository->messages($session->userId(), $conversationRequest->userId()), Validation::failure('message', 'Puste pole'));
            }
            if (!preg_match('/^[a-zA-Z-0-9ąćęłńóśźż?,._\-\s]{1,400}$/', $conversationRequest->Message())) {
                return new ConversationView($session->userId(), $messageRepository->messages($session->userId(), $conversationRequest->userId()), Validation::failure('message', 'Niedozwolone znaki, lub za długi tekst'));
            }
            $messageReaction->addMessage($session->userId(), $conversationRequest->userId(), $conversationRequest->message());
        }
        return new ConversationView($session->userId(), $messageRepository->messages($session->userId(), $conversationRequest->userId()), Validation::success());
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
