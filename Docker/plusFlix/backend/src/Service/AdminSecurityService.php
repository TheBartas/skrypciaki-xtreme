<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AdminSecurityService {
    public function checkAdminLoggedIn(Request $request): ? Response
    {
        if ($request->cookies->get('admin_logged_in') !== '1') {
            return new RedirectResponse('/admin/login');
        }
        return null;
    }
}