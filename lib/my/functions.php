<?php

function toupper( $content )
{
  $content = strtr( $content, "абвгдеёжзийклмнорпстуфхцчшщъьыэюя", "АБВГДЕЁЖЗИЙКЛМНОРПСТУФХЦЧШЩЪЬЫЭЮЯ" );
  return strtoupper( $content );
}

function tolower( $content )
{
  $content = strtr( $content, "АБВГДЕЁЖЗИЙКЛМНОРПСТУФХЦЧШЩЪЬЫЭЮЯ", "абвгдеёжзийклмнорпстуфхцчшщъьыэюя" );
  return strtolower( $content );
}

function translit( $st )
{
  $st = strtr( $st, "абвгдежзийклмнопрстуфыэАБВГДЕЖЗИЙКЛМНОПРСТУФЫЭ ", "abvgdegziyklmnoprstufieABVGDEGZIYKLMNOPRSTUFIE_" );
  $st = strtr( $st, array( 'ё' => "yo",
                           'х' => "h",
                           'ц' => "ts",
                           'ч' => "ch",
                           'ш' => "sh",
                           'щ' => "shch",
                           'ъ' => '',
                           'ь' => '',
                           'ю' => "yu",
                           'я' => "ya",
                           'Ё' => "Yo",
                           'Х' => "H",
                           'Ц' => "Ts",
                           'Ч' => "Ch",
                           'Ш' => "Sh",
                           'Щ' => "Shch",
                           'Ъ' => '',
                           'Ь' => '',
                           'Ю' => "Yu",
                           'Я' => "Ya" ) );
  $st = strtr( $st, '!@#$%^&*()_+=-;%:', '_________________' );
  return $st;
}

function capcha_img()
{
  $char                     = rand( 10000, 99999 );
  $_SESSION[ 'capcha_md5' ] = md5( $char );

  $im = imagecreate( 80, 20 ) or die( "Cannot initialize new GD image stream!" );
  $bg = imagecolorallocate( $im, -1, -1, -1 );

  //создаём шум на фоне
  for ( $i = 0; $i <= 56; $i++ )
  {
    $color = imagecolorallocate( $im, rand( 0, 255 ), rand( 0, 255 ), rand( 0, 255 ) ); //задаём цвет
    imagesetpixel( $im, rand( 2, 80 ), rand( 2, 20 ), $color ); //рисуем пиксель
  }

  //выводим символы кода
  for ( $i = 0; $i < strlen( $char ); $i++ )
  {
    $color = imagecolorallocate( $im, rand( 0, 255 ), rand( 0, 128 ), rand( 0, 255 ) ); //задаём цвет
    $x     = 5 + $i * 14;
    $y     = rand( 0, 5 );
    imagestring( $im, 5, $x, $y, substr( $char, $i, 1 ), $color );
  }

  //антикеширование
  header( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
  header( "Cache-Control: no-store, no-cache, must-revalidate" );
  header( "Cache-Control: post-check=0, pre-check=0", false );
  header( "Pragma: no-cache" );

  //создание рисунка
  if ( function_exists( "imagejpeg" ) )
  {
    header( "Content-type: image/jpeg" );
    imagejpeg( $im );
  }
  else
  {
    die( "No image support in this PHP server!" );
  }
  imagedestroy( $im );
  //die();
}

function str_short( $txt, $charNum = 100 )
{
  if ( strlen( $txt ) <= $charNum )
  {
    return $txt;
  }
  $txt = substr( $txt, 0, $charNum );
  while ( !in_array( $q = substr( $txt, -1 ), array( '.', ' ', ',', '!', '?' ) ) )
  {
    $txt = substr( $txt, 0, -1 );
  }
  $txt = substr( $txt, 0, -1 );
  switch ( $q )
  {
    case '.':
    case '?':
    case '!':
      $txt .= $q . '..';
      break;
    case ',':
    case ' ':
      $txt .= '...';
      break;
  }

  return $txt;
}

function utf8json( $inArray, $reverse = false )
{

  /* our return object */
  $newArray = array();

  /* step through inArray */
  foreach ( $inArray as $key=> $val )
  {
    if ( is_array( $val ) )
    {
      /* recurse on array elements */
      $newArray[ $key ] = utf8json( $val, $reverse );
    }
    else
    {
      /* encode string values */
      if ( $reverse )
      {
        $newArray[ $key ] = stripslashes( utf8_decode( $val ) );
      }
      else
      {
        $newArray[ $key ] = utf8_encode( $val );
      }
    }
  }

  /* return utf8 encoded array */
  return $newArray;
}

function file_check_dir_filename( $dir, $file, $crypt = false )
{
  $file = tolower( translit( $file ) );
  $q    = explode( ".", $file );
  $ext  = array_pop( $q );
  $aDir = explode( "/", $dir );

  if ( $aDir[ 0 ] == "img" )
  {
    if ( $ext != "jpg" && $ext != "jpeg" && $ext != "png" && $ext != "gif" )
    {
      return false;
    }
  }
  if ( $aDir[ 0 ] == "downloads" )
  {
    if ( $ext != "doc" && $ext != "jpg" && $ext != "txt" && $ext != "gif" && $ext != "rtf" && $ext != "png" && $ext != "pdf" && $ext != "txt" && $ext != "ppt" && $ext != "zip" && $ext != "rar" && $ext != "rar" && $ext != "zip" && $ext != "swf" && $ext != "chm"
    )
    {
      return false;
    }
  }

  if ( $crypt )
  {
    do
    {
      $file = substr( md5( mt_rand( 0, 100 ) . time() ), 0, 8 ) . "." . $ext;
    } while ( file_exists( $dir . $file ) );
  }
  else
  {
    while ( file_exists( $dir . $file ) )
    {
      $file = substr( md5( mt_rand( 0, 100 ) . time() ), 0, 8 ) . "." . $ext;
    }
  }
  return $file;
}

function file_copy_resize_image( $src, $dest, $width, $height, $rgb = 0xFFFFFF, $quality = 85 )
{
  if ( !file_exists( $src ) )
  {
    return false;
  }
  $size = getimagesize( $src );
  if ( $size == false )
  {
    return false;
  }
  $width  = (int) $width;
  $height = (int) $height;
  if ( !$width || !$height )
  {
    return false;
  }
  // Определяем исходный формат по MIME-информации, предоставленной
  // функцией getimagesize, и выбираем соответствующую формату
  // imagecreatefrom-функцию.
  $format = tolower( substr( $size[ 'mime' ], strpos( $size[ 'mime' ], '/' ) + 1 ) );
  $icfunc = "imagecreatefrom" . $format;
  if ( !function_exists( $icfunc ) )
  {
    return false;
  }

  //$this->check_filename($dest);
  //$a=explode(".",$src);
  //$ext=$a[count($a)-1];
  //$ext=tolower($ext);
  //if($ext!="jpeg"&&$ext!="jpg"&&$ext!="png"&&$ext!="gif") return false;
  //$size=getimagesize($src);
  //проверяем размер изображения
  if ( $size[ 0 ] > $width || $size[ 1 ] > $height )
  {
    $x_ratio = $width / $size[ 0 ];
    $y_ratio = $height / $size[ 1 ];

    $ratio       = min( $x_ratio, $y_ratio );
    $use_x_ratio = ( $x_ratio == $ratio );

    $new_width  = $use_x_ratio ? $width : floor( $size[ 0 ] * $ratio );
    $new_height = !$use_x_ratio ? $height : floor( $size[ 1 ] * $ratio );
    $new_left   = $use_x_ratio ? 0 : floor( ( $width - $new_width ) / 2 );
    $new_top    = !$use_x_ratio ? 0 : floor( ( $height - $new_height ) / 2 );
  }
  else
  {
    if ( copy( $src, $dest ) )
    {
      return true;
    }
    else
    {
      return false;
    }
    //$new_width=$size[0];
    //$new_height=$size[1];
    //$width=$size[0];
    //$height=$size[1];
  }

  $new_left = 0;
  $new_top  = 0;

  $isrc = $icfunc( $src );
  //if($ext=="jpeg"||$ext=="jpg") $isrc=imagecreatefromjpeg($src);
  //if($ext=="png") $isrc=imagecreatefrompng($src);
  //if($ext=="gif") $isrc=imagecreatefromgif($src);
  $idest = imagecreatetruecolor( $new_width, $new_height );

  imagefill( $idest, 0, 0, $rgb );
  imagecopyresampled( $idest, $isrc, $new_left, $new_top, 0, 0, $new_width, $new_height, $size[ 0 ], $size[ 1 ] );

  imagejpeg( $idest, $dest, $quality );

  imagedestroy( $isrc );
  imagedestroy( $idest );

  return true;
}

function getApcCache()
{
  return extension_loaded( 'apc' ) ? new Doctrine_Cache_Apc() : null;
}

function mb_trim( $string )
{
  $string = preg_replace( '/&nbsp;/us', ' ', $string );
  $string = trim( preg_replace( "/(\s+)|(\s+$)/us", " ", $string ) );
  return $string;
}

function words_match( $request, $result )
{
  preg_match_all( "/([A-Za-z]+)/", $request, $res );
  $request_splitted = $res[ 1 ];
  preg_match_all( "/([A-Za-z]+)/", $result, $res );
  $result_splitted = $res[ 1 ];
  $k               = 0;
  $words_match     = true;
  while ( ( $words_match == true ) && ( $k < count( $request ) ) )
  {
    $words_match = false;
    $l           = 0;
    while ( ( $words_match == false ) && ( $l < count( $result_splitted ) ) )
    {
      if ( strtolower( $request_splitted[ $k ] ) == strtolower( $result_splitted[ $l ] ) )
      {
        $words_match = true;
      }
      $l++;
    }
    $k++;
  }
  return $words_match;
}

function int_to_str( $Int )
{
  $str = '';
  if ( $Int > 999 )
  {
    $str .= format_thousand( substr( $Int, 0, -3 ), true );
    $str .= ' ' . Util::getCorrectWord( substr( $Int, 0, -3 ), array( 'тысяча', 'тысячи', 'тысяч' ) );
    $str .= ' ';
  }
  $str .= format_thousand( $Int % 1000 );

  return $str;
}

function format_thousand( $Int, $Female = false )
{
  $str = '';
  if ( $Int > 99 )
  {
    switch ( substr( $Int, -3, 1 ) )
    {
      case 1:
        $str .= 'сто ';
        break;
      case 2:
        $str .= 'двести ';
        break;
      case 3:
        $str .= 'триста ';
        break;
      case 4:
        $str .= 'четыреста ';
        break;
      case 5:
        $str .= 'пятьсот ';
        break;
      case 6:
        $str .= 'шестьсот ';
        break;
      case 7:
        $str .= 'семьсот ';
        break;
      case 8:
        $str .= 'восемьсот ';
        break;
      case 9:
        $str .= 'девятьсот ';
        break;
    }
  }

  if ( $Int > 19 )
  {
    switch ( substr( $Int, -2, 1 ) )
    {
      case 2:
        $str .= 'двадцать ';
        break;
      case 3:
        $str .= 'тридцать ';
        break;
      case 4:
        $str .= 'сорок ';
        break;
      case 5:
        $str .= 'пятьдесят ';
        break;
      case 6:
        $str .= 'шестьдесят ';
        break;
      case 7:
        $str .= 'семьдесят ';
        break;
      case 8:
        $str .= 'восемьдесят ';
        break;
      case 9:
        $str .= 'девяносто ';
        break;
    }
  }

  switch ( substr( $Int, -1, 1 ) )
  {
    case 1:
      $str .= $Female ? 'одна ' : 'один ';
      break;
    case 2:
      $str .= 'два ';
      break;
    case 3:
      $str .= 'три ';
      break;
    case 4:
      $str .= 'четыре ';
      break;
    case 5:
      $str .= 'пять ';
      break;
    case 6:
      $str .= 'шесть ';
      break;
    case 7:
      $str .= 'семь ';
      break;
    case 8:
      $str .= 'восемь ';
      break;
    case 9:
      $str .= 'девять ';
      break;
    case 10:
      $str .= 'десять ';
      break;
    case 11:
      $str .= 'одиннадцать ';
      break;
    case 12:
      $str .= 'двенадцать ';
      break;
    case 13:
      $str .= 'тинадцать ';
      break;
    case 14:
      $str .= 'четырнадцать ';
      break;
    case 15:
      $str .= 'пятнадцать ';
      break;
    case 16:
      $str .= 'шестнадцать ';
      break;
    case 17:
      $str .= 'семнадцать ';
      break;
    case 18:
      $str .= 'восемнадцать ';
      break;
    case 19:
      $str .= 'девятнадцать ';
      break;
  }

  return $str;
}

function requests_from_hotel_name( $hotel_name )
{
  preg_match_all( "/([A-Za-z]+)/", $hotel_name, $result );
  $request            = Array();
  $requests_forbidden = array( ' HOTEL', ' BEACH', ' RESORT', ' CLUB', ' PARK' );
  for ( $i = 0; $i <= count( $result[ 1 ] ); $i++ )
  {
    $new_request = '';
    for ( $j = 0; $j < count( $result[ 1 ] ); $j++ )
    {
      if ( $j != count( $result[ 1 ] ) - $i )
      {
        $new_request = $new_request . " " . $result[ 1 ][ $j ];
      }
    }
    foreach ( $requests_forbidden as $request_forbidden )
    {
      if ( $new_request == $request_forbidden )
      {
        $new_request = '';
      }
    }

    if ( $new_request )
    {
      $request[ ] = urlencode( strtolower( $new_request ) );
    }
  }
  return $request;
}

/**
 * Вставляет css в страницу (для динамических виджетов)
 * @param $file
 */
function inline_stylesheet( $file )
{
  $key = 'inline_stylesheet_' . $file;
  if ( dm::getRequest()->getAttribute( $key, false ) ) return;

  $file = substr( $file, 0, 1 ) == '/' ? $file : '/theme/css/' . $file . '.css';
  $file = sfConfig::get( 'sf_web_dir' ) . $file ;

  echo '<style type="text/css">'. str_replace( "\n", "", file_get_contents( $file ) ) .'</style>';
  echo "\n";

  dm::getRequest()->setAttribute( $key, true );
}

/**
 * Вставляет js в страницу (для динамических виджетов)
 * @param $file
 */
function inline_javascript( $file )
{
  $key = 'inline_javascript_' . $file;
  if ( dm::getRequest()->getAttribute( $key, false ) ) return;

  $file = substr( $file, 0, 1 ) == '/' ? $file : '/theme/js/' . $file . '.js';
  $file = sfConfig::get( 'sf_web_dir' ) . $file ;

  echo '<script type="text/javascript">'. file_get_contents( $file ) .'</script>';
  echo "\n";

  dm::getRequest()->setAttribute( $key, true );
}

