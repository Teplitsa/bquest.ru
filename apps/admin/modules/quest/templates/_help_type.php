<?php
/**
 * User: makz
 * Date: 24.11.12
 * Time: 16:07
 */

$choices = Quest::getHelpTypeChoices();

echo $choices[ $quest->help_type ];
