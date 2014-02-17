<?php
/**
 * Created by Mota-systems company.
 * Author: Pavel Lamzin
 * Date: 17.02.14
 * Time: 2:29
 * All rights are reserved
 */

class UsersModule extends CWebModule
{
    public function init()
    {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application

        // import the module-level models and components
        $this->setImport(array(
            'users.models.*',
            'users.components.*',
        ));
    }
}