<?php
/**
 * Render a page.
 * Layout areas and page content area are rendered.
 *
 * @var dmFrontPageBaseHelper $helper      ( page_helper service )
 * @var boolean               $isEditMode  ( whether the user is allowed to edit page )
 */
?>

<div id="dm_page" class="layout_wrapper<?php $isEditMode && print ' edit'; ?>">

  <div class="layout_center"><div class="layout_header">
    <?php include_partial( 'main/header' ); ?>
  </div></div>

  <?php echo _tag( 'div.layout_fullwidth.layout_infoline', Quest::getInfoLine() ); ?>

  <div class="layout_center"><div class="layout_content">

    <div class="layout_messages">
      <?php include_partial( 'main/messages' ); ?>
    </div>

    <?php echo $helper->renderArea( 'page.content', array( 'class' => array( 'maincol' ) ) ); ?>

    <?php echo $helper->renderArea( 'layout.right', array( 'class' => array( 'sidebar' ) ) ); ?>

    <div class="clear"></div>

  </div></div>

  <div class="layout_footer_buffer"></div>

</div>

<div class="layout_center layout_footer_wrapper"><div class="layout_footer">
  <?php include_partial( 'main/footer' ); ?>
</div></div>

<?php
/*
<div class="dm_layout">
echo $helper->renderArea('layout.top', '.clearfix');
echo $helper->renderArea('layout.left');
echo $helper->renderArea('layout.bottom', '.clearfix');
</div>
*/
?>

