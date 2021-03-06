<?php

/*
 * This file is part of the PaymentSuite package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 */

namespace PaymentSuite\PayUBundle\Model;

use PaymentSuite\PayuBundle\Model\Abstracts\PayuReportRequest;

/**
 * OrderDetailByReferenceCode Request Model
 */
class OrderDetailByReferenceCodeRequest extends PayuReportRequest
{
    /**
     * @var OrderDetailByReferenceCodeDetails
     *
     * details
     */
    protected $details;
}
