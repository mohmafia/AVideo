<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Routing\Tests\Fixtures;

use Symfony\Component\Routing\Matcher\RedirectableUrlMatcherInterface;
use Symfony\Component\Routing\Matcher\UrlMatcher;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
class RedirectableUrlMatcher extends UrlMatcher implements RedirectableUrlMatcherInterface
{
    public function redirect(string $path, string $route, string $scheme = null): array
    {
        return [
            '_controller' => 'Some controller reference...',
            'path' => $path,
            'scheme' => $scheme,
        ];
    }
}
