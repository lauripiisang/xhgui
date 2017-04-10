<?php

class Xhgui_Util
{
    /**
     * Creates a simplified URL given a standard URL.
     * Does the following transformations:
     *
     * - Remove numeric values after =.
     *
     * @param string $url
     * @return string
     */
    public static function simpleUrl($url)
    {
        $callable = Xhgui_Config::read('profiler.simple_url');
        if (is_callable($callable)) {
            return call_user_func($callable, $url);
        }
        return preg_replace('/\=\d+/', '', $url);
    }

	/**
	 * Takes an array as input, replaces keys that contain '.' with $replacement
	 * Non-recursive
	 * Returns the modified array
	 *
	 * @param $array
	 * @param string $replacement
	 * @return array
	 */
	public static function escapeDotKeys($array, $replacement = '_dot_') {
		$dotKeys = array_filter(array_keys($array), function ($key){
			return strstr('.', $key );
		});
		foreach ($dotKeys as $dotKey){
			$escapedKey = str_replace('.', $replacement, $dotKey);
			$array[$escapedKey] = $array[$dotKey];
			unset($array[$dotKey]);
		}
		return $array;
    }
}
