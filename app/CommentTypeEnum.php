<?php

namespace App;

enum CommentTypeEnum: string
{
    case Comment = 'comment';
    case Reply = 'reply';
}
