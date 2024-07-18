<?php

namespace App\Enums;

enum CommentTypeEnum: string
{
    case Comment = 'comment';
    case Reply = 'reply';
}
