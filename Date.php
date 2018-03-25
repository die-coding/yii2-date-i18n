<?php
/**
 * @Author            : Die Coding <www.diecoding.com>
 * @Date              : 08 March 2018
 * @Email             : diecoding@gmail.com
 * @Last modified by  : Die Coding <www.diecoding.com>
 * @Last modified time: 25 March 2018
 * @License           : MIT
 * @Copyright         : 2018
 */


namespace diecoding\components;

use Yii;
use yii\base\Component;

/**
  *
  * @author Die Coding <diecoding@gmail.com>
  * @since 0.0.0
  */
class Date extends Component
{

  const DAY   = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

  const MONTH = ['', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

  /**
   * @inheritdoc
   */
  public function init()
  {
    parent::init();
    if (!isset(Yii::$app->i18n->translations['die-components'])) {
      Yii::$app->i18n->translations['die-components'] = [
        'class'          => 'yii\i18n\PhpMessageSource',
        'sourceLanguage' => 'en',
        'basePath'       => '@diecoding/date/i18n/i18n',
      ];
    }
  }

  /**
   * @inheritdoc
   */
  public function isToday($date)
  {
    $date  = $this->date($date);
    $today = date('dmY', $date);

    return $today === date('dmY');
  }

  /**
   * @inheritdoc
   */
  public function d($date = null)
  {
    $date = $this->date($date);
    $day  = date('w', $date);
    $d    = self::DAY;

    return Yii::t('die-components', $d[$day]);
  }

  /**
   * @inheritdoc
   */
  public function m($date = null)
  {
    $date  = $this->date($date);
    $month = date('n', $date);
    $m     = self::MONTH;

    return Yii::t('die-components', $m[$month]);
  }

  /**
   * @inheritdoc
   */
  public function dmy($date = null)
  {
    $date = $this->date($date);
    $d    = date('d', $date);
    $m    = $this->m($date);
    $y    = date('Y', $date);
    $out  = "{$d} {$m} {$y}";

    return $out;
  }

  /**
   * @inheritdoc
   */
  public function ldmy($date = null)
  {
    $date = $this->date($date);
    $l    = $this->d($date);
    $d    = date('d', $date);
    $m    = $this->m($date);
    $y    = date('Y', $date);
    $out  = "{$l}, {$d} {$m} {$y}";

    return $out;
  }

  /**
   * @inheritdoc
   */
  public function ldmyhi($date = null)
  {
    $date = $this->date($date);
    $l    = $this->d($date);
    $d    = date('d', $date);
    $m    = $this->m($date);
    $y    = date('Y', $date);
    $h    = date('H', $date);
    $i    = date('i', $date);
    $out  = "{$l}, {$d} {$m} {$y} " . Yii::t('die-components', '-') . " {$h}:{$i}";

    return $out;
  }

  /**
   * @inheritdoc
   */
  public function ldmyhis($date = null)
  {
    $date = $this->date($date);
    $l    = $this->d($date);
    $d    = date('d', $date);
    $m    = $this->m($date);
    $y    = date('Y', $date);
    $h    = date('H', $date);
    $i    = date('i', $date);
    $s    = date('s', $date);
    $out = "{$l}, {$d} {$m} {$y} " . Yii::t('die-components', '-') . " {$h}:{$i}:{$s}";

    return $out;
  }

  /**
   * @inheritdoc
   */
  private function date($date)
  {
    if (!$date) {
      $date = date('r');
    }

    if (!strtotime($date)) {
      return $date;
    }

    return strtotime($date);
  }
}
