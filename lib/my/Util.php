<?php

class Util
{

  static $months_genetive = array
  (
    1 => 'Января',
    2 => 'Февраля',
    3 => 'Марта',
    4 => 'Апреля',
    5 => 'Мая',
    6 => 'Июня',
    7 => 'Июля',
    8 => 'Августа',
    9 => 'Сентября',
    10 => 'Октября',
    11 => 'Ноября',
    12 => 'Декабря',
  );

  static $months = array
  (
    1 => 'Январь',
    2 => 'Февраль',
    3 => 'Март',
    4 => 'Апрель',
    5 => 'Май',
    6 => 'Июнь',
    7 => 'Июль',
    8 => 'Август',
    9 => 'Сентябрь',
    10 => 'Октябрь',
    11 => 'Ноябрь',
    12 => 'Декабрь',
  );

  static $week_days_when = array(
    'в воскресенье',
    'в понедельник',
    'во вторник',
    'в среду',
    'в четверг',
    'в пятницу',
    'в субботу',
  );

  public static function pre($var)
  {
    echo "<pre>";
    echo var_dump($var);
    echo '</pre>';
  }

  public static function pri($var)
  {
    echo "<pre>";
    echo print_r($var);
    echo '</pre>';
  }

  public static function uid($prefix = '')
  {
    static $microtime = NULL;
    if (NULL === $microtime) {
      $microtime = preg_replace('%\D%', '', microtime(true));
    }
    return $prefix . (++$microtime);
  }

  public static function url( $absolute = false )
  {
    $url = $_SERVER['REQUEST_URI'];

    if ( $absolute )
    {
      $url = 'http://' . $_SERVER['HTTP_HOST'] . $url;
    }

    return $url;
  }

  public static function toInt($str = '')
  {
    return (int)preg_replace('/[^(\d)]+/', '', $str);
  }

  public static function slugify($text)
  {
    $text = self::translit($text);
    $text = preg_replace('/\W+/', '-', $text);
    $text = strtolower(trim($text, '-'));

    return $text;
  }

  public static function slugify_ru($text)
  {
    $text = mb_strtolower($text, 'UTF-8');
    $text = trim(preg_replace('/[^0-9_a-zа-яё]+/u', '_', $text));

    return $text;
  }

  public static function translit($text)
  {
    $trans = array(
      "а" => "a",
      "б" => "b",
      "в" => "v",
      "г" => "g",
      "д" => "d",
      "е" => "e",
      "ё" => "e",
      "ж" => "zh",
      "з" => "z",
      "и" => "i",
      "й" => "y",
      "к" => "k",
      "л" => "l",
      "м" => "m",
      "н" => "n",
      "о" => "o",
      "п" => "p",
      "р" => "r",
      "с" => "s",
      "т" => "t",
      "у" => "u",
      "ф" => "f",
      "х" => "kh",
      "ц" => "ts",
      "ч" => "ch",
      "ш" => "sh",
      "щ" => "shch",
      "ы" => "y",
      "э" => "e",
      "ю" => "yu",
      "я" => "ya",
      "А" => "A",
      "Б" => "B",
      "В" => "V",
      "Г" => "G",
      "Д" => "D",
      "Е" => "E",
      "Ё" => "E",
      "Ж" => "Zh",
      "З" => "Z",
      "И" => "I",
      "Й" => "Y",
      "К" => "K",
      "Л" => "L",
      "М" => "M",
      "Н" => "N",
      "О" => "O",
      "П" => "P",
      "Р" => "R",
      "С" => "S",
      "Т" => "T",
      "У" => "U",
      "Ф" => "F",
      "Х" => "Kh",
      "Ц" => "Ts",
      "Ч" => "Ch",
      "Ш" => "Sh",
      "Щ" => "Shch",
      "Ы" => "Y",
      "Э" => "E",
      "Ю" => "Yu",
      "Я" => "Ya",
      "ь" => "",
      "Ь" => "",
      "ъ" => "",
      "Ъ" => ""
    );
    if (preg_match("/[а-яА-Я]/", $text)) {
      return strtr($text, $trans);
    }
    else
    {
      return $text;
    }
  }

  public static function puntoRU2EN( $text )
  {
    $ru = array( 'й','ц','у','к','е','н','г','ш','щ','з','х','ъ','ф','ы','в','а','п','р','о','л','д','ж','э','я','ч','с','м','и','т','ь','б','ю','.' );
    $en = array( 'q','w','e','r','t','y','u','i','o','p','[',']','a','s','d','f','g','h','j','k','l',';', '\'','z','x','c','v','b','n','m',',','.','/' );

    return strtr( $text, array_combine( $ru, $en ) );
  }

  public static function OK()
  {
    $values = array(
      "OK",
      "Хорошо",
      "Отлично",
      "Супер",
      "Здорово",
      "Замечательно",
    );

    shuffle($values);

    return current($values);
  }

  public static function getSfErr($field)
  {
    $err = array(
      'class' => $field->hasError() ? "error" : "",
      'title' => $field->hasError() ? "<span>" . htmlspecialchars($field->renderError()) . "</span>" : "",
    );

    return (object)$err;
  }

  /**
   * @param $str
   * @return string
   */
  public static function hudate($str)
  {
    if ( strcmp( $str, (int) $str ) == 0 )
    {
      $time = (int) $str;
    }
    else
    {
      $time = strtotime( $str );
    }

    $ago = time() - $time;

    if ( $ago < 0 )
    {
      $Hi = date( 'в H:i', $time );
      if ( $Hi == 'в 00:00' ) $Hi = '';

      $return = sprintf('%s %s %s %s',
        self::day($time),
        mb_strtolower(self::$months_genetive[self::month($time)], 'UTF-8'),
        self::year($time),
        $Hi
      );
    }
    elseif ($ago < 60)
    {
      $return = 'только что';
    }
      // меньше часа назад
      // ху минут назад
    elseif ($ago < 3600)
    {
      $minutes = array('минуту', 'минуты', 'минут');
      $ago_min = ceil($ago / 60);
      $return = sprintf('%s %s назад', $ago_min, self::getCorrectWord($ago_min, $minutes));
    }
      // больше часа и создан сегодня
      // сегодня в ЧЧ:ММ
    elseif (date('d-m-y') == date('d-m-y', $time))
    {
      $return = sprintf('сегодня в %s', date('H:i', $time));
    }
      // день вчера
      // вчера в ЧЧ:ММ
    elseif (date('d-m-y') == date('d-m-y', $time + 86400))
    {
      $return = sprintf('вчера в %s', date('H:i', $time));
    }
      // иначе
      // ЧЧ %месяц% ГГГГ в ЧЧ:ММ
    else
    {
      $Hi = date( 'в H:i', $time );
      if ( $Hi == 'в 00:00' ) $Hi = '';

      $return = sprintf('%s %s %s %s',
        self::day($time),
        mb_strtolower(self::$months_genetive[self::month($time)], 'UTF-8'),
        self::year($time),
        $Hi
      );
    }

    return $return;

  }

  public static function hutime($str, $opts = array())
  {
    $default = array(
      'with_seconds' => false,
      'short_minutes' => false,
    );
    $options = array_merge($default, $opts);

    $time = strtotime($str);
    $return = '';

    if (date('G', $time)) {
      $num = date('G', $time);
      $return .= sprintf('%s %s ', $num, self::getCorrectWord($num, array('час', 'часа', 'часов')));
    }
    if (date('j', $time)) {
      $num = date('i', $time);
      $minutes = $options['short_minutes'] ? 'мин.' : self::getCorrectWord($num, array('минута', 'минуты', 'минут'));
      $return .= sprintf('%s %s', $num, $minutes);
    }

    return $return;
  }

  public static function day($timestamp = null, $with_zero = false)
  {
    $format = $with_zero ? 'd' : 'j';
    return date($format, $timestamp);
  }

  public static function month($timestamp = null, $with_zero = false)
  {
    $format = $with_zero ? 'm' : 'n';
    return date($format, $timestamp);
  }

  public static function year($timestamp = null)
  {
    return date('Y', $timestamp);
  }

/**
 * @static
 * @param  $num
 * @param  array $words три слова: напр.: Array( год, года лет )
 * @return
 */
  public static function getCorrectWord($num, $words)
  {
    $suf = $num % 100;

    if ($suf > 5 && $suf < 20) {
      return $words[2];
    }

    switch ($suf % 10)
    {
      case 1:
        return $words[0];
        break;

      case 2:
      case 3:
      case 4:
        return $words[1];
        break;

      default:
        return $words[2];
        break;
    }
  }

  /**
   * trims text to a space then adds ellipses if desired
   * @param string $input text to trim
   * @param int $length in characters to trim to
   * @param bool $ellipses if ellipses (...) are to be added
   * @param bool $strip_html if html tags are to be stripped
   * @return string
   */
  public static function trim($input, $length, $ellipses = true, $strip_html = true)
  {
    //strip tags, if desired
    if ($strip_html)
    {
      $input = strip_tags($input);
      $input = self::htmltrim( $input );
    }

    $input = preg_replace( '# +#mui', ' ', $input );
    $input = preg_replace( '#^ #mui', '', $input );
    $input = preg_replace( '# $#mui', '', $input );
    $input = trim( $input );

    //no need to trim, already shorter than trim length
    if (strlen($input) <= $length) {
      return $input;
    }

    //find last space within length
    $last_space = strrpos(substr($input, 0, $length), ' ');
    $trimmed_text = substr($input, 0, $last_space);

    //add ellipses (...)
    if ($ellipses) {
      $trimmed_text .= '...';
    }

    return $trimmed_text;
  }

  public static function trimArray( array $array, $length = 255 )
  {
    foreach ( $array as $key => $val )
    {
      $array[ $key ] = self::trim( $val, $length );

      if ( ! $array[ $key ] )
      {
        unset( $array[ $key ] );
      }
    }

    return $array;
  }

  public static function htmltrim($string)
  {
    $pattern = '(?:[ \t\n\r\x0B\x00\x{A0}\x{AD}\x{2000}-\x{200F}\x{201F}\x{202F}\x{3000}\x{FEFF}]|&nbsp;|<br\s*\/?>)+';
    return preg_replace('/^' . $pattern . '|' . $pattern . '$/u', '', $string);
  }

  static function domain($end_slash = false)
  {
    $end = $end_slash ? '/' : '';
    return 'http://' . $_SERVER['HTTP_HOST'] . $end;
  }

  static function hudomain()
  {
    $d = explode( ':', $_SERVER['HTTP_HOST'] );

    return $d[0];
  }

  static function hudomain_base()
  {
    $d = explode( '.', self::hudomain() );

    return $d[ sizeof( $d ) - 2 ] . '.' . $d[ sizeof( $d ) - 1 ];
  }

  public static function wordform($str)
  {
    $length = mb_strlen($str, 'UTF-8');
    if ($length <= 3) {
      return false;
    }

    $cut = false;
    if ($length >= 5) {
      $cut = -1;
    }
    elseif ($length >= 6) {
      $cut = -2;
    }

    return $cut ? mb_substr($str, 0, $cut, 'UTF-8') : $str;
  }

  public function sqlsearch($str)
  {
    $str = mb_strtolower($str, 'UTF-8');
    $str = preg_replace('/[^а-яё a-z]/u', '', $str);
    $str = preg_replace('/ {1,}/u', ' ', $str);
    $str = trim($str);
    if (mb_strlen($str, 'UTF-8') === 0) {
      return false;
    }

    $words = explode(' ', $str);
    foreach ($words as $k => $v)
    {
      if ($v = self::wordform($v)) {
        $words[$k] = $v;
      }
      else
      {
        unset($words[$k]);
      }
    }
    if (count($words) === 0) {
      return false;
    }

    $str = implode('%', $words);

    return "%$str%";
  }

// STATIC CACHE
  protected static $cache = array();

  public static function getCache( $key )
  {
    return isset( self::$cache[$key] ) ? self::$cache[$key] : null;
  }

  public static function setCache( $key, $value )
  {
    self::$cache[$key] = $value;
  }
// END OF STATIC CACHE

  public static function formatBytes( $bytes, $precision = 2 )
  {
    $units = array( 'Б', 'Кб', 'Мб', 'Гб', 'Тб' );

    $bytes = max( $bytes, 0 );
    $pow = floor( ( $bytes ? log( $bytes ) : 0 ) / log( 1024 ) );
    $pow = min( $pow, count( $units ) - 1 );

    // Uncomment one of the following alternatives
    // $bytes /= pow(1024, $pow);
    $bytes /= (1 << (10 * $pow));

    return round( $bytes, $precision ) . ' ' . $units[ $pow ];
  }

/**
 * Если в строке присутствует 1 число и символы - вернет число, иначе 0
 * @static
 * @param $str
 * @return int
 */
  public static function str2int( $str )
  {
    preg_match( '/\d+/mui', $str, $matches );
    return isset( $matches[ 0 ] ) ? (int) $matches[ 0 ] : 0;
  }

/**
 * @static
 * @param int $length
 * @return string
 */
  public static function generatePassword ($length = 8)
  {

    // start with a blank password
    $password = "";

    // define possible characters - any character in this string can be
    // picked for use in the password, so if you want to put vowels back in
    // or add special characters such as exclamation marks, this is where
    // you should do it
    $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";

    // we refer to the length of $possible a few times, so let's grab it now
    $maxlength = strlen($possible);

    // check for length overflow and truncate if necessary
    if ($length > $maxlength) {
      $length = $maxlength;
    }

    // set up a counter for how many characters are in the password so far
    $i = 0;

    // add random characters to $password until $length is reached
    while ($i < $length) {

      // pick a random character from the possible ones
      $char = substr($possible, mt_rand(0, $maxlength-1), 1);

      // have we already used this character in $password?
      if (!strstr($password, $char)) {
        // no, so it's OK to add it onto the end of whatever we've already got...
        $password .= $char;
        // ... and increase the counter by one
        $i++;
      }

    }

    // done!
    return $password;
  }

  public static function getQueryLikeTemplates( $query, $minLength = 3, $maxLength = 32 )
  {
    if ( mb_strlen( $query, 'UTF-8') > $maxLength  )
    {
      $query = substr( $query, 0, $maxLength );
    }

    $words = explode( ' ', $query );

    foreach ( $words as $key => $val )
    {
      if ( mb_strlen( $val, 'UTF-8' ) < $minLength )
      {
        unset ( $words[ $key ] );
      }
    }

    $queries = array();
    $queries[] = implode( '%', $words ) . '%';
    $queries[] = '%' . implode( '%', $words ) . '%';

    if ( sizeof( $words ) >= 3 )
    {
      $words = array_reverse( $words );
      foreach ( $words as $key => $val )
      {
        $fewWords = $words;
        unset( $fewWords[ $key ] );
        $fewWords = array_reverse( $fewWords );

        $queries[] = implode( '%', $fewWords ) . '%';
        $queries[] = '%' . implode( '%', $fewWords ) . '%';
      }
    }

    return $queries;
  }

  public static function ucfirst( $str )
  {
    $enc = 'UTF-8';
    return mb_strtoupper(mb_substr($str, 0, 1, $enc), $enc).mb_substr($str, 1, mb_strlen($str, $enc), $enc);
  }

  public static function getRealIp()
  {
    if ( isset( $_SERVER['HTTP_X_REAL_IP'] ) )
    {
      return $_SERVER['HTTP_X_REAL_IP'];
    }
    return false;
  }

  public static function closetags( $html )
  {
    preg_match_all( '#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result );
    $openedtags = $result[ 1 ];
    preg_match_all( '#</([a-z]+)>#iU', $html, $result );
    $closedtags = $result[ 1 ];
    $len_opened = count( $openedtags );
    if ( count( $closedtags ) == $len_opened )
    {
      return $html;
    }
    $openedtags = array_reverse( $openedtags );
    for ( $i = 0; $i < $len_opened; $i++ )
    {
      if ( !in_array( $openedtags[ $i ], $closedtags ) )
      {
        $html .= '</' . $openedtags[ $i ] . '>';
      }
      else
      {
        unset( $closedtags[ array_search( $openedtags[ $i ], $closedtags ) ] );
      }
    }
    return $html;
  }

  public static function isValidEmail ( $email )
  {
    return preg_match( '/^[^@]+@[a-zA-Z0-9._-]+\.[a-zA-Z]+$/', $email );
  }

  public static function sanitizeHtml( $html, array $opts )
  {
    require_once ( "phpQuery.php" );
    if ( isset ( $opts [ "tags" ] ) )
    {
      $whiteTags = $opts [ "tags" ];
    }
    if ( isset ( $opts [ "attrs" ] ) )
    {
      $whiteAttrs = $opts [ "attrs" ];
    }
    if ( isset ( $opts [ "tag_attrs" ] ) )
    {
      $tagAttrs = $opts [ "tag_attrs" ];
    }
    $html = phpQuery::newDocument ( $html );
    foreach ( $html->find ( '*' )  as $tag)
    {
      $remove = false;
      $tagName = $tag->tagName;
      $attributes = pq ( $tag )->attr ( '*' );
      if ( isset ( $whiteTags ) )
      {
        if ( ! in_array( $tagName, $whiteTags) )
        {
          pq ( $tag )->remove();
          $remove = true;
        }
      }
      if ( isset ( $whiteAttrs ) && ( isset ( $attributes ) ) && ! $remove )
      {
        $attributeNames = array_keys ( $attributes );
        $indicatorSpecialTagName = false; // индикатор наличия для тега особых настроек удаления аттрибутов
        if ( isset ( $tagAttrs ) )
        {
          $specialTagName = array_keys ( $tagAttrs );
          if ( in_array( $tagName, $specialTagName) )
          {
            $indicatorSpecialTagName = true;
            foreach ( $tagAttrs as $tagNameSpecial => $specialWhiteAttrs )
            {
              if ( $tagNameSpecial == $tagName )
              {
                foreach ( $attributeNames as $attrName )
                {
                  if ( ! in_array ( $attrName, $specialWhiteAttrs ) )
                  {
                    pq ( $tag )->removeAttr ( $attrName );
                  }
                }
              }
            }
          }
        }
        if ( ! $indicatorSpecialTagName )
        {
          foreach ( $attributeNames as $attrName )
          {
            if ( ! in_array ( $attrName, $whiteAttrs ) )
            {
              pq ( $tag )->removeAttr ( $attrName );
            }
          }
        }
      }

    }
    return $html;
  }

  public static function obj2arr( $object )
  {
    $array = array();

    foreach( $object as $key => $val )
    {
      $array[ $key ] = $val;
    }

    return $array;
  }

  public static function htmlEntityRemove( $str )
  {
    $str = str_replace( '&nbsp;', ' ', $str );
    return preg_replace("/&#?[a-z0-9]{2,8};/i","",$str);
  }

  public static function debug(  )
  {
    $obj = debug_backtrace();

    foreach( $obj as $line )
    {
      echo "{$line['file']} {$line['line']}<br>";
    }
  }

  public static function download( $from, $to, $timeout = 60 )
  {
    $fp = fopen( $to, "w" );

    if ( ! $fp )
    {
      throw new Exception( "Download could not open file for writing: " . $to );
    }

    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_VERBOSE, 0 );
    curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout );
    curl_setopt( $ch, CURLOPT_URL, $from );
    curl_setopt( $ch, CURLOPT_FAILONERROR, true );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_FILE, $fp );

    $response = curl_exec( $ch );

    if ( $response === false )
    {
      return false;
    }
    curl_close( $ch );
    fclose( $fp );

    return true;
  }

  public static function getShortDate( $str )
  {
    if ( strcmp( $str, (int) $str ) == 0 )
    {
      $time = (int) $str;
    }
    else
    {
      $time = strtotime( $str );
    }

    $day = date( 'd', $time );

    $month = self::$months[ date( 'm', $time ) ];

    $month = mb_strtolower( mb_substr( $month, 0, 3, 'UTF-8' ), 'UTF-8' );

    return "{$day} {$month}";
  }

}

