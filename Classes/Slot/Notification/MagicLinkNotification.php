<?php
declare(strict_types = 1);

namespace LMS\Flogin\Slot\Notification;

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

use LMS\Flogin\Domain\Model\Request\MagicLinkRequest;

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
class MagicLinkNotification extends \LMS\Flogin\Notification\AbstractNotificationSender
{
    /**
     * Build the MagicLinkNotification Template and email the user
     *
     * @param \LMS\Flogin\Domain\Model\Request\MagicLinkRequest $request
     */
    public function send(MagicLinkRequest $request): void
    {
        $receiver = [$request->getUser()->getEmail() => $request->getUser()->getUsername()];

        $this->sendViaMail($receiver, compact('request'));
    }

    /**
     * {@inheritDoc}
     */
    protected function getSubject(): string
    {
        return $this->translate(
            $this->getSettings()['magicLink.']['subject']
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function getTemplateSuffix(): string
    {
        return 'Email/MagicLink';
    }
}
