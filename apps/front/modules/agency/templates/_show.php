<?php

/**
 * @var Agency $agency
 */

echo _tag( 'h1', $agency->name );

include_partial( 'agency/card', array( 'agency' => $agency ) );

echo _tag( 'div.separator' );

include_partial( 'agency/quests', array( 'agency' => $agency ) );