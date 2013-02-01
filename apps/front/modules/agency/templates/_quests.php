<?php
/**
 * User: makz
 * Date: 24.11.12
 * Time: 15:33
 *
 * @var Agency $agency
 */

$link = function( Quest $quest )
{
  global $agency;

  /** @var dmFrontUser $sfUser  */
  $sfUser = dm::getUser();
  $dmUser = $sfUser->getDmUser();

  $html = _link( $quest );

  if ( ! $sfUser->isAuthenticated() || $dmUser->getUserType() != DmUser::TYPE_AGENCY || $dmUser->Agency->id != $quest->agency_id )
  {
    return $html;
  }

  $html .= ' &nbsp; ';
  $html .= _link( 'quest/form' )->param( 'id', $quest->id )->text( 'Редактировать' )->set( '.small_button' );

  if ( $quest->isStatusNew() )
  {
    $html .= ' &nbsp; ';
    $html .= link_to( 'Удалить', "quest/delete?id={$quest->id}", array(
      'confirm' => 'Задание будет безвозвратно удалено. Продолжить?',
      'class' => 'small_button red_button',
    ) );
  }

  $html .= ' &nbsp; ';

  return $html;
};

echo _tag( 'h1', 'Созданные задания' );

if ( $agency->getQuests()->count() == 0 )
{
  echo _tag( 'div.layout_messages', _tag( 'div.note', 'Нет созданных заданий' ) );
  return;
}

echo _open( 'ul' );

if ( $agency->getClosedQuests()->count() + $agency->getReadyQuests()->count() > 0 )
{
  echo _tag( 'li', _tag( 'h3', 'Выполненные' ) );

  foreach ( $agency->getClosedQuests() as $quest )
  {
    $rating = $quest->rating . ' ' . Util::getCorrectWord( $quest->rating, array( 'балл', 'балла', 'баллов' ) );

    echo _tag( 'li', $link( $quest ) . ' выполнено, рейтинг: ' . $rating );
  }
  foreach ( $agency->getReadyQuests() as $quest )
  {
    echo _tag( 'li', $link( $quest ) . ' выполнено, ожидает оценки' );
  }
}

if ( $agency->getAssignedQuests()->count() > 0 )
{
  echo _tag( 'h3', 'Активные' );

  foreach ( $agency->getAssignedQuests() as $quest )
  {
    echo _tag( 'li', $link( $quest ) . ' принято командой ' . _link( $quest->Team ) );
  }
}

if ( $agency->getNewQuests()->count() > 0 )
{
  echo _tag( 'h3', 'Новые' );

  foreach ( $agency->getNewQuests() as $quest )
  {
    echo _tag( 'li', $link( $quest ) . ' ожидает исполнителя' );
  }
}

echo _tag( 'ul' );
