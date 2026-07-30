<?php
/**
 * เลือกภาษาปัจจุบันจาก query string (?lang=) แล้วจำค่าไว้ด้วย cookie
 * ต้อง require ไฟล์นี้ก่อนมี output ใดๆ เพราะมีการเรียก setcookie()
 */

const SITE_LANGUAGES = ['th', 'en'];
const SITE_DEFAULT_LANGUAGE = 'th';

function resolve_site_language(): string
{
    if (isset($_GET['lang']) && in_array($_GET['lang'], SITE_LANGUAGES, true)) {
        $lang = $_GET['lang'];
        setcookie('site_lang', $lang, time() + 60 * 60 * 24 * 365, '/');
        return $lang;
    }

    if (isset($_COOKIE['site_lang']) && in_array($_COOKIE['site_lang'], SITE_LANGUAGES, true)) {
        return $_COOKIE['site_lang'];
    }

    return SITE_DEFAULT_LANGUAGE;
}
