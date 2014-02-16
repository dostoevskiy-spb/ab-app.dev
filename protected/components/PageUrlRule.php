<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mota-systems
 * Date: 19.02.13
 * Time: 17:37
 * To change this template use File | Settings | File Templates.
 */
class PageUrlRule extends CBaseUrlRule
{

    /**
     * Creates a URL based on this rule.
     * @param CUrlManager $manager the manager
     * @param string $route the route
     * @param array $params list of parameters (name=>value) associated with the route
     * @param string $ampersand the token separating name-value pairs in the URL.
     * @return mixed the constructed URL. False if this rule does not apply.
     */
    public function createUrl($manager, $route, $params, $ampersand)
    {
        $pages = Page::model()->findAll();
        $items = array();
        foreach($pages as $page)
            $items[] = $page->link;
        if ($route=='site/page' AND isset($params['page']))
        {
            return $params['page'];
        }
        return false;
    }

    /**
     * Parses a URL based on this rule.
     * @param CUrlManager $manager the URL manager
     * @param CHttpRequest $request the request object
     * @param string $pathInfo path info part of the URL (URL suffix is already removed based on {@link CUrlManager::urlSuffix})
     * @param string $rawPathInfo path info that contains the potential URL suffix
     * @return mixed the route that consists of the controller ID and action ID. False if this rule does not apply.
     */
    public function parseUrl($manager, $request, $pathInfo, $rawPathInfo)
    {
        if(preg_match('/(^[a-zA-Z_]{0,50}|^$)/i', $pathInfo, $matches)){
            $pages = Page::model()->findAll();
            foreach ($pages as $page){
                if($matches[0]==$page->link)
                    return 'site/page';
            }
        }
        return FALSE;
    }
}
