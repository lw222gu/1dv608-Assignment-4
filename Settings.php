<?php

class Settings {
    /**
     * This settings file lets you set some constant values on your own.
     * Change the values for the constants below, to match your requirements,
     * or leave them as they are.
     *
     * You need to rename this file Settings.php, even if you keep the constant values.
     */

    /**
     * SESSION NAMES:
     * Set your own session names below, or use the ones already filled in.
     */
    const APP_SESSION_TEMP_USER = "tempUser";
    const APP_SESSION_IS_LOGGED_IN = "isLoggedIn";

    /**
     * DATA PATH:
     * You can choose to use the "data" directory already created in this component,
     * or you can use your own data storage directory. If you want to use the directory
     * in this component, leave the DATA_PATH constant as it is, otherwise set it to
     * the directory you want to use.
     *
     * If you choose to have your data storage directory inside the webroot like in this
     * component, remember you need the .htaccess file inside the directory, to prevent access
     * to your files through a browser. You also need to give your server the rights to write
     * to that directory, for it to be able to access and use the user files.
     */
    const DATA_PATH = "data/";
}