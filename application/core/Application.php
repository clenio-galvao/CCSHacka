<?php

namespace Core;

class Application
{
  protected static $globals;
  protected static $codes;
  public static $uri;

  protected static function normalize(array $target)
  {
    $normalized = array();
    foreach($target as $key => $value) $normalized[strtolower($key)] = $value;

    return $normalized;
  }

  protected static function treatGlobals()
  {
    self::$globals = self::normalize($GLOBALS);

    unset(self::$globals['globals'], self::$globals['path'], $GLOBALS);

    foreach(self::$globals as $name => $global) self::$globals[$name] = self::normalize($global);
  }

  public static function configure()
  {
    self::treatGlobals();

    self::$uri = self::$globals['_server']['request_uri'];
  }

  protected static function write(string $text, string $mime, int $code)
  {
    $codes = array(
      200 => 'Ok',
      404 => 'Not found',
    );

    if(! array_key_exists($code, $codes)) return false;

    header(sprintf('HTTP/1.1 %s %s', $code, $codes[$code]));
    header(sprintf('Content-Type: %s', $mime));

    file_put_contents('php://output', $text);
  }


  protected static function hasContent(string $path, &$content)
  {
    if(! (file_exists($path) and is_readable($path) and $content = file_get_contents($path))) return false;

    $extension = preg_match("/(?'extension'\..+)$/m", $path, $matches) ? $matches['extension'] : '';
    $mimetype  = Information::hasMimeType($extension);

    Template::treat($content, $extension);

    $content = array(
                      'body' => $content,
                      'mime' => Information::hasMimeType($extension),
                    );

    return true;
  }

  public static function send(string $path)
  {
    if(self::hasContent($path, $content)) return self::write($content['body'], $content['mime'], 200);
                                          return self::sendNotFound();
  }

  public static function sendNotFound()
  {
    self::write('Conteúdo não encontrado.', 'text/html', 404);
  }
}
