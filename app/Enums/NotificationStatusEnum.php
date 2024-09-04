<?php

namespace App\Enums;

enum NotificationStatusEnum: string
{
    case UNREAD = 'unread';
    case READ = 'read';
    case ARCHIEVED = 'archived';

    case POSTCREATED = 'post_created';
    case POSTUPDATED = 'post_updated';
    case POSTDELETED = 'post_deleted';
    case POSTLIKED = 'post_liked';
    case POSTCOMMENTED = 'post_commented';
    case POSTREPLIED = 'post_replied';
    case POSTREPORTED = 'post_reported';
    case POSTPUBLISHED = 'post_published';
    case POSTUNPUBLISHED = 'post_unpublished';

    case EVENTCREATED = 'event_created';
    case EVENTUPDATED = 'event_updated';
    case EVENTDELETED = 'event_deleted';
    case EVENTRESTORED = 'event_restored';
    case EVENTPUBLISHED = 'event_published';
    case EVENTUNPUBLISHED = 'event_unpublished';
    case EVENTINVITED = 'event_invited';
    case EVENTJOINED = 'event_joined';
    case EVENTLEFT = 'event_left';
    case EVENTCLOSED = 'event_closed';

    case PAGECREATED = 'page_created';
    case PAGEUPDATED = 'page_updated';
    case PAGEDELETED = 'page_deleted';
    case PAGERESTORED = 'page_restored';
    case PAGEPUBLISHED = 'page_published';
    case PAGEUNPUBLISHED = 'page_unpublished';
    case PAGEFOLLOWED = 'page_followed';
    case PAGEUNFOLLOWED = 'page_unfollowed';
    case PAGEINVITED = 'page_invited';
    case PAGEJOINED = 'page_joined';
    case PAGELEFT = 'page_left';
    case PAGECLOSED = 'page_closed';
}