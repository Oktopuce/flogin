<?php
declare(strict_types = 1);

namespace LMS\Login\Notification;

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

use LMS\Login\Support\TypoScript;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use LMS3\Support\{StaticCreator, Extbase\View\HtmlView};
use TYPO3\CMS\Core\{Mail\MailMessage, Utility\GeneralUtility};

/**
 * @author Sergey Borulko <borulkosergey@icloud.com>
 */
abstract class AbstractNotificationSender
{
    use HtmlView, StaticCreator;

    /**
     * Sends the email to proper location based on abstract functions
     *
     * @param array $receiver
     * @param array $variables
     */
    protected function sendViaMail(array $receiver, array $variables = []): void
    {
        $view = $this->getExtensionView($this->getTemplateSuffix(), $variables);

        $mail = GeneralUtility::makeInstance(MailMessage::class);
        $mail
            ->setSubject($this->getSubject())
            ->setTo($receiver)
            ->setBody($view->render(), 'text/html')
            ->send();
    }

    /**
     * @param string $path
     * @param array  $arguments
     *
     * @return string
     */
    protected function translate(string $path, $arguments = []): string
    {
        return LocalizationUtility::translate($path, null, $arguments) ?: '';
    }

    /**
     * @return array
     */
    protected function getSettings(): array
    {
        return TypoScript::getSettings()['email.'];
    }

    /**
     * @return string
     */
    abstract protected function getTemplateSuffix(): string;

    /**
     * @return string
     */
    abstract protected function getSubject(): string;
}
