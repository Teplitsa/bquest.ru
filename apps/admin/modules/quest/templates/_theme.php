<?php
/**
 * User: makz
 * Date: 24.11.12
 * Time: 16:07
 */

$choices = Quest::getThemeChoices();

echo $choices[ $quest->theme ];
