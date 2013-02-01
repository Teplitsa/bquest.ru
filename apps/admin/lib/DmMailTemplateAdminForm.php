<?php

/**
 * Переопределенный класс, добавлен ckeditor для is_html макетов
 */
class DmMailTemplateAdminForm extends BaseDmMailTemplateForm
{

  public function configure()
  {
    parent::configure();

    if ( 'embed' == sfConfig::get( 'dm_i18n_form' ) )
    {

      $cultures = sfConfig::get( 'dm_i18n_cultures' );

      foreach ( $cultures as $culture )
      {
        $this->widgetSchema[ $culture ][ 'subject' ] = new sfWidgetFormInputText();
        $this->widgetSchema[ $culture ][ 'body' ]->setAttribute( 'rows', 15 );
        $this->widgetSchema[ $culture ][ 'description' ]->setAttribute( 'rows', 2 );

        // ckeditor hack
        if( $this->object && $this->object->is_html  )
        {
          $this->widgetSchema[$culture]['body'] = new sfWidgetFormTextareaDmCkEditor(array(
            'ckeditor' => $this->getService('ckeditor')
          ));
        }
      }
    }
    else
    {

      $this->widgetSchema[ 'subject' ] = new sfWidgetFormInputText();
      $this->widgetSchema[ 'body' ]->setAttribute( 'rows', 15 );
      $this->widgetSchema[ 'description' ]->setAttribute( 'rows', 2 );

      // ckeditor hack
      if( $this->object && $this->object->is_html  )
      {
        $this->widgetSchema['body'] = new sfWidgetFormTextareaDmCkEditor(array(
          'ckeditor' => $this->getService('ckeditor')
        ));
      }
    }

    // Unset automatic fields like 'created_at', 'updated_at', 'created_by', 'updated_by'
    $this->unsetAutoFields();

    unset( $this[ 'vars' ] );
  }

}