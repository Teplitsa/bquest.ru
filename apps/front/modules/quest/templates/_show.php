<?php
/**
 * @var Quest $quest
 * @var QuestCompleteForm $formComplete
 * @var QuestCloseForm $formClose
 */

/** @var dmFrontUser $sfUser  */
$sfUser = dm::getUser();
$dmUser = $sfUser->getDmUser();

inline_stylesheet( 'quest/show' );

echo _tag( 'h1', $quest->getName() );

if ( $quest->description )
{
  echo _tag( 'div.description', _tag( 'h3', 'Описание' ) . markdown( $quest->description ) );
  echo _tag( 'div.separator' );
}

if ( $quest->team_id && $sfUser->isAuthenticated() && $dmUser->user_type == DmUser::TYPE_TEAM && $quest->team_id == $dmUser->Team->id )
{
  echo _tag( 'h3', 'Координатор' );

  $agency = $quest->Agency;

  echo _tag( 'div', $agency->coordinator_name );
  echo _tag( 'div', $agency->coordinator_telephone );
  echo _tag( 'div', $agency->DmUser->email );

  echo _tag( 'div.separator' );
}

$class = $quest->status > Quest::STATUS_ASSIGNED ? '.col' : '';
$link = $quest->Agency->getWebsiteSmart() ? _link( $quest->Agency->getWebsiteSmart() ) : '';

echo _open( 'div.double_column_container' );
  echo _open( 'div' . $class );
    $img = $quest->dm_media_id ? _media( $quest->DmMedia )->width( 150 )->method( 'center' ) : '';
    echo _tag( 'div.image', $img );
    echo _tag( 'div.clear.vpad5' );
    echo _tag( 'div.agency.blocky.shady.round'
      , _tag( 'h3.inline', 'Инициатор: ' . _link( $quest->Agency ) )
      . _tag( 'p', $link  )
      . markdown( Util::trim( $quest->Agency->description, 500 ) )
    );
    echo _tag( 'div', 'Создано ' . Util::hudate( $quest->created_at ) );
    if ( $quest->created_at != $quest->updated_at )
    {
      echo _tag( 'div', 'Изменено ' . Util::hudate( $quest->updated_at ) );
    }
    echo _tag( 'div.deadline', 'Выполнить до: ' . Util::hudate( $quest->deadline ) );
    if ( $quest->address )
    {
      //echo _tag( 'p.address', _tag( 'strong', 'Адрес: ' . $quest->address ) );
    }

  echo _close( 'div' );

  if ( $quest->status > Quest::STATUS_ASSIGNED )
  {
    echo _open( 'div' . $class );
      echo _tag( 'h3.team', 'Команда-исполнитель: ' . _link( $quest->Team ) );
      $img = $quest->report_image_id ? _media( $quest->ReportImage )->width( 150 )->method( 'center' ) : '';
      if ( $img )
      {
        echo _tag( 'div.image', $img );
        echo _tag( 'div.clear.vpad5' );
      }
      if ( $quest->report_text )
      {
        echo _tag( 'div.report', _tag( 'b', 'Отчет: ' ) . markdown( $quest->report_text ) );
      }
      if ( $quest->rating )
      {
        echo _tag( 'i.rating', 'Оценка: ' . $quest->rating );
      }
    echo _close( 'div' );
  }

echo _close( 'div' );

if ( $quest->latlng )
{
  include_partial( 'main/googleMap', array( 'latlng' => $quest->latlng, 'label' => $quest->name ) );
}

if ( $quest->isStatusNew() && $dmUser->user_type == DmUser::TYPE_TEAM && $dmUser->Team->is_active )
{
  echo link_to( 'Взяться за задачу', "team/acceptQuest?id={$quest->id}&code={$dmUser->Team->getCode()}", array(
    'class'   => 'big_button',
    'confirm' => 'Подтвердите, что беретесь выполнить данное задание'
  ) );
}

if ( $quest->isStatusAssigned() && $dmUser->user_type == DmUser::TYPE_TEAM && $quest->team_id == $dmUser->Team->id )
{
  echo _open( 'div.complete_controls' );
  echo _tag( 'a.big_button.complete href=#complete name=complete', 'Завершить' );
  echo '&nbsp;&nbsp;&nbsp;&nbsp;';
  echo link_to( 'Отказаться от задачи', "team/declineQuest?id={$quest->id}&code={$dmUser->Team->getCode()}", array(
    // 'class'   => 'big_button',
    'confirm' => 'Подтвердите, что Вы отказываетесь от задания'
  ) );
  echo _close( 'div' );

  echo _open( 'div.complete_form.hidden' );
  echo $formComplete->open( array( 'class' => 'myform' ) );
  echo _open( 'ul' );
  echo $formComplete['hours']->renderRow();
  echo $formComplete['report_text']->renderRow();
  echo $formComplete['video_url']->renderRow();
  echo $formComplete['photo_url']->renderRow();
  echo $formComplete['report_image_id_form']['file']->renderRow( array(), 'Фотография');
  echo _tag( 'li.center', _tag( 'button', 'Сохранить' ) . ' &nbsp; ' . _tag( 'a.cancel.imlink href=#', 'Отмена' ) );
  echo _close( 'ul' );
  echo $formComplete->renderHiddenFields();
  echo $formComplete->close();
}

if ( $quest->isStatusReady() && $dmUser->user_type == DmUser::TYPE_AGENCY && $quest->agency_id == $dmUser->Agency->id )
{
  echo _open( 'div.close_controls' );
  echo _tag( 'a.big_button.close href=#close name=close', 'Завершить' );
  echo _close( 'div' );

  echo _open( 'div.close_form.hidden' );
  echo $formClose->open( array( 'class' => 'myform' ) );
  echo _open( 'ul' );
  echo $formClose['rating']->renderRow();
  echo _tag( 'li.center', _tag( 'button', 'Сохранить' ) . ' &nbsp; ' . _tag( 'a.cancel.imlink href=#', 'Отмена' ) );
  echo _close( 'ul' );
  echo $formClose->renderHiddenFields();
  echo $formClose->close();
}

?>

<script type="text/javascript">

  $(function()
  {
    var $form = $( '.quest_show .complete_form form' );
    var $ctrl = $( '.quest_show .complete_controls' );

    $( '.quest_show .complete' ).click( function( e )
    {
      e.preventDefault();

      $form.parent().show();
      $ctrl.hide();
    });

    $( '.cancel', $form ).click( function( e )
    {
      e.preventDefault();

      $form.parent().hide();
      $ctrl.show();
    } );

    window.CKEDITOR_BASEPATH = dm_configuration.relative_url_root+'/dmCkEditorPlugin/js/ckeditor/';

    var $textarea = $( 'textarea.dm_ckeditor', $form );
    $textarea.ckeditor( function (){}, $textarea.metadata() );
  });

  $(function()
  {
    var $form = $( '.quest_show .close_form form' );
    var $ctrl = $( '.quest_show .close_controls' );

    $( '.quest_show .close' ).click( function( e )
    {
      e.preventDefault();

      $form.parent().show();
      $ctrl.hide();
    });

    $( '.cancel', $form ).click( function( e )
    {
      e.preventDefault();

      $form.parent().hide();
      $ctrl.show();
    } );

  });

</script>