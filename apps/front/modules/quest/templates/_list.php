<?php
/**
 * @var dmFrontPagerView|Quest[] $pager
 * @var QuestFormFilter $filter
 */

echo $filter->render( array('class' => 'myfilter' ) );

echo $pager->renderNavigationTop();

$actions = function( Quest $quest )
{
  /** @var dmFrontUser $sfUser  */
  $sfUser = dm::getUser();
  $dmUser = $sfUser->getDmUser();

  if ( ! $sfUser->isAuthenticated() || $dmUser->user_type != DmUser::TYPE_TEAM || ! $quest->isStatusNew() )
  {
    return _tag( 'b', mb_strtolower( $quest->getStatusString() ) );
  }

  $team = $dmUser->Team;

  $html = link_to( 'Взяться за задачу', "team/acceptQuest?id={$quest->id}&code={$team->getCode()}", array(
    'class'   => 'small_button',
    'confirm' => 'Подтвердите, что беретесь выполнить данное задание'
  ) );

  return $html;
};

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
    . _tag( 'td', $actions( $quest ) )
  );
}
echo _close( 'table' );

echo $pager->renderNavigationBottom();
