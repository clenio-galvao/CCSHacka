<?php

namespace Core;

class Information
{
  protected static $contexts;
  protected static $mimetypes;

  protected static function getContents(string $name)
  {
    $path = sprintf('%sapplication/core/%s.json', ROOTSERVER, $name);

    if(file_exists($path) and $json = file_get_contents($path) and $abs = json_decode($json, true)) return $abs;
                                                                                                    return array();
  }

  public static function configure()
  {
    self::$mimetypes = self::getContents('mimetypes');
    self::$contexts  = self::getContents('context');
  }

  public static function hasContext(string $uri, &$treated = null)
  {
    foreach(self::$contexts as $name => $context) {
      if($treated = preg_filter(sprintf('/^\/%s/', preg_quote($context, '/')), '', $uri)) return $name;
    }

    $treated = substr($uri, 1) . '.html';

    return 'html';
  }

  public static function getPath(string $target, string $uri)
  {
    foreach(self::$contexts as $name => $context) if($target === $name) 
                                                    return file_exists($path = ROOTSERVER . $context . $uri) ? $path : '';
                                                    return '';
  }

  public static function hasMimeType(string $target)
  {
    foreach(self::$mimetypes as $mimetype) if($target === $mimetype['name']) return $mimetype['template'];
                                                                             return false;
  }
}
