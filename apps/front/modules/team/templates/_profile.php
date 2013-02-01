<?php
/**
 * User: makz
 * Date: 19.11.12
 * Time: 14:09
 *
 * @var Team $object
 * @var QuestFormFilter $filter
 * @var Quest[]|dmFrontPagerView $pager
 */

// $availableQuests = Quest::getAvailable();

$assignedQuests = $object->getAssignedQuests();

inline_stylesheet( 'team/profile' );

include_partial( 'team/card', array( 'team' => $object ) );

if ( sizeof( $assignedQuests ) < Team::MAX_ASSIGNED_QUESTS )
{
  echo _tag( 'div.separator' );

  echo _tag( 'h2', 'Выбрать задание' );

  echo $filter->render( array('class' => 'myfilter' ) );

  echo _open( 'table.p5.quests' );
  echo _tag( 'tr', '<th colspan="2">Задание</th><th>Тематика</th><th>Вид помощи</th><th>Дедлайн</th><th></th>' );
  foreach ( $pager as $quest )
  {
    $img = $quest->dm_media_id ? _media( $quest->DmMedia )->size( 24, 24 )->method( 'center' ): '';

    echo _tag( 'tr'
    , _tag( 'td', _link( $quest )->text( $img )->set( '.img' ) )
    . _tag( 'td', _tag( 'div.wrap.oneline', _link( $quest )->set( 'title', Util::trim( $quest->description, 1000 ) ) ) )
    . _tag( 'td', $quest->getThemeStr() )
    . _tag( 'td', $quest->getHelpTypeStr() )
    . _tag( 'td', Util::hudate( $quest->deadline ) )
    . _tag( 'td', link_to( 'Взяться за задачу', "team/acceptQuest?id={$quest->id}&code={$object->getCode()}", array( 'class' => 'small_button', 'confirm' => 'Подтвердите, что беретесь выполнить данное задание' ) ) )
    );
  }
  echo _close( 'table' );

  echo $pager->renderNavigation();
}

if ( sizeof( $assignedQuests ) > 0 )
{
  echo _tag( 'div.separator' );
  echo _tag( 'h2', 'Текущие задания' );
  echo _open( 'ul' );
  foreach ( $assignedQuests as $quest )
  {
    echo _tag( 'li'
      , _link( $quest )
      . ' '
      . link_to( 'Отказаться',  "team/declineQuest?id={$quest->id}&code={$object->getCode()}", array( 'class' => 'small_button', 'confirm' => 'Подтвердите, что вы отказываетесь выполнять данное задание' ) )
    );
  }
  echo _tag( 'ul' );
}

include_partial( 'team/questsReady', array( 'quests' => $object->getReadyQuests() ) );