<?php
declare(strict_types = 1);

namespace LMS\Login\Slot\Action\MagicLink;

/* * *************************************************************
 *
 *  Copyright notice
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

use LMS\Login\Domain\Model\Link;
use LMS\Login\Support\Redirection\UserRouter;
use LMS\Login\Domain\Model\Request\MagicLinkRequest;
use LMS\Login\Slot\Notification\MagicLinkNotification;

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
class LinkRequested
{
    /**
     * Magic link request detected.
     * Provide any actions to send the link here
     *
     * @psalm-suppress InternalMethod
     *
     * @param \LMS\Login\Domain\Model\Request\MagicLinkRequest $request
     */
    public function execute(MagicLinkRequest $request): void
    {
        Link::create([
            'token' => $request->getToken(),
            'user' => $request->getUser()->getUid()
        ]);

        MagicLinkNotification::make()->send($request);

        UserRouter::redirectToAfterMagicLinkSentPage();
    }
}