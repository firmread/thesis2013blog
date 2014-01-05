<?php
class Vcard_Creator {
    private static function getVcf($data, $version = 2.1) {
        $ret = "BEGIN:VCARD\r\n";
        $ret .= "VERSION:" . $version . "\r\n";
        $ret .= isset($data['name']) ? "N:" . esc_html($data['name']) . "\r\n" : "";
        $ret .= isset($data['name']) ? "FN:" . esc_html($data['name']) . "\r\n" : "";
        $ret .= isset($data['company']) ? "ORG:" . esc_html($data['company']) . "\r\n" : "";
        $ret .= isset($data['address']) ? "ADR;WORK:" . esc_html($data['address']) . "\r\n" : "";
        $ret .= isset($data['phone']) ? "TEL;WORK;VOICE;PREF:" . esc_html($data['phone']) . "\r\n" : "";
        $ret .= isset($data['fax']) ? "TEL;WORK;FAX:" . esc_html($data['fax']) . "\r\n" : "";
        $ret .= isset($data['email']) ? "EMAIL;INTERNET;PREF:" . esc_html($data['email']) . "\r\n" : "";
        $ret .= isset($data['url']) ? "URL;WORK;PREF:" . esc_html($data['url']) . "\r\n" : "";
        $ret .= isset($data['note']) ? "NOTE:" . esc_html($data['note']) . "\r\n" : "";
        if ($version == 3)
            $ret .= isset($data['icon']) ? "PHOTO;VALUE=URL;TYPE=PNG:" . esc_html($data['icon']) . "\r\n" : "";
        $ret .= "REV:3\r\n";
        $ret .= "END:VCARD\r\n";
        return $ret;
    }
    public static function displayVcard($data) {
        header("Content-type:text/x-vcard");
        header('Content-Disposition: attachment; filename=contact.vcf');
        echo self::getVcf($data);
    }
    public static function displayiOSVcard($data) {
        header("Content-type: text/x-vcalendar; charset=utf-8");
        header("Content-Disposition: attachment; filename=\"iphonecontact.ics\";");
        echo "BEGIN:VCALENDAR\n";
        echo "VERSION:2.0\n";
        echo "BEGIN:VEVENT\n";
        echo "SUMMARY:Click the attached contact below to save to your contacts\n";
        $dtstart = date("Ymd") . "T" . date("Hi") . "00";
        echo "DTSTART;TZID=Europe/London:" . $dtstart . "\n";
        $dtend = date("Ymd") . "T" . date("Hi") . "01";
        echo "DTEND;TZID=Europe/London:" . $dtend . "\n";
        echo "DTSTAMP:" . $dtstart . "Z\n";
        echo "ATTACH;VALUE=BINARY;ENCODING=BASE64;FMTTYPE=text/directory;\n";
        echo " X-APPLE-FILENAME=iphonecontact.vcf:\n";
        $b64vcard = base64_encode(self::getVcf($data));         $b64mline = chunk_split($b64vcard, 74, "\n");         $b64final = preg_replace('/(.+)/', ' $1', $b64mline);         echo $b64final;         echo "END:VEVENT\n";
        echo "END:VCALENDAR\n";
    }
}
