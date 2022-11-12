<?php
namespace Mess\Application\Operation;

use Mess\Application\Constraints\FormatPost;
use Mess\Persistence\Database\Post\PostRepository;
use Mess\View\Views\ValidationErrors;

class InsertPostOperation implements Operation
{
    public function __construct(private PostRepository $addingPost,
                                private int            $userId,
                                private string         $post,
                                private string         $date)
    {
    }

    public function apply(ValidationErrors $errors): void
    {
        $constraint = new FormatPost($this->post);
        if ($constraint->fails()) {
            $constraint->addError($errors);
        } else {
            $this->addingPost->addPost($this->userId, $this->post, $this->date);
        }
    }
}