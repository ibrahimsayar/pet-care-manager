<?php

namespace App\Enums;

enum AdministrationPeriodEnum: string
{
    case HOURLY = 'HOURLY';
    case DAILY = 'DAILY';
    case WEEKLY = 'WEEKLY';
    case YEARLY = 'YEARLY';
}
