<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Admins Controller
 *
 * @property \Authentication\Controller\Component\AuthenticationComponent $Authentication
 */
abstract class AdminBaseController extends AppController
{
    /**
     * @return void
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Authentication.Authentication');

        $this->viewBuilder()
            ->setTheme('MyAdminLTE')
            ->setClassName('AdminLTE.AdminLTE');
    }
}
