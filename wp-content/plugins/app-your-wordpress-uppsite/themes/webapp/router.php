<?php
global $wp_query;
$type = $value = "";
$list_type = is_single() || is_page() ? "full" : "titles";
foreach ($wp_query->query as $paramName => $paramValue) {
    if (!empty($paramValue)) {
        $type = $paramName;
        $value = $paramValue;
    }
}
$forceBlog = in_array(uppsite_get_type(), array(UPPSITE_TYPE_BUSINESS, UPPSITE_TYPE_BOTH)) && !is_page() ? "&doUppSiteBlog" : "";
wp_safe_redirect(sprintf("%s?is_uppsite=1%s#%s/%s/%s", home_url(), $forceBlog, $list_type, $type, $value));
exit;
