<?php

$quote = Quote::getRandom();

echo _link( '@homepage' )->set( '.logo' );

echo _tag( 'div.menu', get_component( 'main', 'menu' ) );

echo _tag( 'div.quote', "“{$quote->text}” — " . _tag( 'span', $quote->author ) );
