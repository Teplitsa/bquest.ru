<?php

/**
 * @var Message $message
 */

echo _tag( 'h1', $message->name );

echo _tag( 'i.date', $message->getCreatedString() );

echo _tag( 'div.markdown', $message->text );