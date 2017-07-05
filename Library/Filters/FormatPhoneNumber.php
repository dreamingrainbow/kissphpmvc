<?php
class FormatPhoneNumber
{
    public static function filter($phoneNumber)
    {
        $str = preg_replace( '/[\!\@\#\$\%\^\&\*\(\)\-\+\_\+\`\~\{\[\}\]\\\|\;\:\'\"\,\<\.\>\?\/\sa-zA-z]/','', $phoneNumber);
        return sprintf('(%s) %s-%s', substr($str, 0, 3), substr($str, 3,3), substr($str, 6,10));
    }
}