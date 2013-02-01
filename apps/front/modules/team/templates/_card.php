<?php
/**
 * User: makz
 * Date: 24.11.12
 * Time: 15:23
 *
 * @var Team $team
 */

$img = $team->dm_media_id ? _media( $team->DmMedia )->size( 150, 150 )->set( '.round' ) : '';

$hours = $team->getHours();
$rating = $team->getRating();

inline_stylesheet( 'team/profile_card' );

if ( $team->Quests->count() == 0 )
{
  echo _tag( 'div.layout_messages', _tag( 'div.note', 'Вы не выполнили ни одного задания' ) );
}

echo _open( 'div.team_profile_card' );

echo _tag( 'div.image.shady.round', $img );

echo _tag( 'h3', $team->name );

if ( $rating )
{
  echo _tag( 'div.rating', 'Рейтинг команды: ' . $rating );
}
if ( $hours )
{
  echo _tag( 'div.hours', 'Потрачено ' . $hours . ' ' . Util::getCorrectWord( $hours, array('час', 'часа', 'часов'  ) ) );
}
if ( dm::getUser()->isAuthenticated() && dm::getUser()->getDmUser()->id == $team->dm_user_id )
{
  echo _tag( 'p', _link( 'team/form' )->text( 'Редактировать профиль' )->set( '.small_button' ) );
}

echo _tag( 'div.clear' );

echo _close( 'div' );
