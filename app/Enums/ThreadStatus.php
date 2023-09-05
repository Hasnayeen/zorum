<?php

namespace App\Enums;

enum ThreadStatus: string {
    case Draft = 'draft';
    case Pending = 'pending';
    case Rejected = 'rejected';
    case Published = 'published';
    case Archived = 'archived';
    case Closed = 'closed';
    case Flagged = 'flagged';
}
