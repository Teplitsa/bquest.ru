<?php
/**
 * @var Team $team
 */

echo _tag( 'h1', $team->name );

include_partial( 'team/card', array( 'team' => $team ) );

include_partial( 'team/questsReady', array( 'quests' => $team->getReadyQuests() ) );
