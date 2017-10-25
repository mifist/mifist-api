<?php
namespace includes\common;


class MifistDefaultOption
{
    /**
     * Возвращает массив дефолтных настроек
     * @return array
     */
    public static function getDefaultOptions()
    {
        $defaults = array(
            'starter' => array(
                'marker' => ' ',
                'token' => ' ',
	            'checkbox' => '0'
            )
        );
        // Фильтр которому можно подключиться и
	    // изменить массив дефолтных настроек
        $defaults = apply_filters('mifist_default_option', $defaults );
        return $defaults;
    }
}