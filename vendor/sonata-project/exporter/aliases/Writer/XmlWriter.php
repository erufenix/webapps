<?php

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Exporter\Writer;

if (!class_exists('\Sonata\\'.__NAMESPACE__.'\XmlWriter', false)) {
    @trigger_error(
        'The '.__NAMESPACE__.'\XmlWriter class is deprecated since version 1.x and will be removed in 2.0.'
        .' Use \Sonata\\'.__NAMESPACE__.'\XmlWriter instead',
        E_USER_DEPRECATED
    );
}

class_alias(
    '\Sonata\\'.__NAMESPACE__.'\XmlWriter',
    __NAMESPACE__.'\XmlWriter'
);

if (false) {
    class XmlWriter extends \Sonata\Exporter\Writer\XmlWriter
    {
    }
}
