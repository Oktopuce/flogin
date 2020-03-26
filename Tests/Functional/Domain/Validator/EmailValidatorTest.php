<?php
declare(strict_types = 1);

namespace LMS\Flogin\Tests\Functional\Domain\Validator;

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

use LMS\Flogin\Domain\Validator\EmailValidator;

/**
 * @author Borulko Sergey <borulkosergey@icloud.com>
 */
class EmailValidatorTest extends \LMS\Flogin\Tests\Functional\BaseTest
{
    /**
     * @test
     */
    public function error_thrown_when_email_does_not_exist(): void
    {
        $validation = (new EmailValidator())->validate('invalid@example.com');

        $this->assertTrue($validation->hasErrors());
    }

    /**
     * @test
     */
    public function pass_when_email_exists(): void
    {
        $validation = (new EmailValidator())->validate('user@example.com');

        $this->assertFalse($validation->hasErrors());
    }
}
