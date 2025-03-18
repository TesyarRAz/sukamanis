<?php

namespace App;

enum StatusPengajuanSurat: string
{
    case Requested = 'requested';
    case Accepted = 'accepted';
    case Rejected = 'rejected';
}
