<?php
/**
 * Created by PhpStorm.
 * User: avant
 * Date: 17.02.17
 * Time: 9:33
 */
?>
<form action="options.php" method="POST">
    <?php
    // скрытые защитные поля
    // register_setting -> $option_group
        settings_fields( 'MainOptions' );
    // секции с настройками (опциями).
    // У нас она всего одна 'section_id'
    //  add_settings_section -> $page (id)
        do_settings_sections( 'mifist_control_options' );
    // Дефолтная кнопка WordPress, сохранить
        submit_button();
    ?>
</form>