<?php
/**
 * User: makz
 * Date: 24.11.12
 * Time: 16:07
 */

if ( ! $quest->status )
{
  $quest->status = Quest::STATUS_NEW;
}

echo mb_strtolower( Quest::$statusChoices[ $quest->status ] );
