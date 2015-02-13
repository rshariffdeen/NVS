<?php

namespace Ridwan\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class RidwanUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
