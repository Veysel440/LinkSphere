<?php

namespace App\Enums;

class ActivityType
{
    const CONNECTION_SENT     = 'connection_sent';
    const CONNECTION_ACCEPTED = 'connection_accepted';
    const CONNECTION_REJECTED = 'connection_rejected';
    const CONNECTION_BLOCKED  = 'connection_blocked';
    const CONNECTION_DELETED  = 'connection_deleted';


    const PROFILE_UPDATED     = 'profile_updated';
    const AVATAR_UPDATED      = 'avatar_updated';
    const PASSWORD_CHANGED    = 'password_changed';


    const EXPERIENCE_ADDED    = 'experience_added';
    const EXPERIENCE_UPDATED  = 'experience_updated';
    const EXPERIENCE_DELETED  = 'experience_deleted';
    const EDUCATION_ADDED     = 'education_added';
    const EDUCATION_UPDATED   = 'education_updated';
    const EDUCATION_DELETED   = 'education_deleted';
    const SKILL_ADDED         = 'skill_added';
    const SKILL_UPDATED       = 'skill_updated';
    const SKILL_DELETED       = 'skill_deleted';

    const SOCIAL_ADDED   = 'social_added';
    const SOCIAL_UPDATED = 'social_updated';
    const SOCIAL_DELETED = 'social_deleted';

    const POST_CREATED = 'post_created';
    const POST_UPDATED = 'post_updated';
    const POST_DELETED = 'post_deleted';
    const REPORT_CREATED = 'report_created';

    const COMMENT_CREATED = 'comment_created';

    const POST_LIKED = 'post_liked';
    const POST_UNLIKED = 'post_unliked';

    const POST_SHARED = 'post_shared';


    const LOGIN               = 'login';
    const LOGOUT              = 'logout';

}
