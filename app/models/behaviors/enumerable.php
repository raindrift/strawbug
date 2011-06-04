<?php
/**
 * Behavior with useful functionality around models containing an enum type field
 *
 * Copyright (c) Debuggable, http://debuggable.com
 *
 * @package default
 * @access public
 */
class EnumerableBehavior extends ModelBehavior {
/**
 * Fetches the enum type options for a specific field
 *
 * @param string $field 
 * @return void
 * @access public
 */
  function enumOptions($model, $field) {
    $cacheKey = $model->alias . '_' . $field . '_enum_options';
    $options = Cache::read($cacheKey);

    if (!$options) {
      $sql = "SHOW COLUMNS FROM `{$model->useTable}` LIKE '{$field}'";
      $enumData = $model->query($sql);

      $options = false;
      if (!empty($enumData)) {
        $patterns = array('enum(', ')', '\'');
        $enumData = r($patterns, '', $enumData[0]['COLUMNS']['Type']);
        $options = explode(',', $enumData);
      }
      Cache::write($cacheKey, $options);
    }
    return $options;
  }
}
?>
