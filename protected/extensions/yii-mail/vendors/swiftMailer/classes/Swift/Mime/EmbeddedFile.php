<?php
/*
 * This file is part of SwiftMailer.
 * (c) 2004-2009 Chris Corbyn
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

//@require 'Swift/Mime/Attachment.php';
//@require 'Swift/Mime/ContentEncoder.php';
//@require 'Swift/KeyCache.php';
//@require

/**
 * An embedded file, in a multipart message.
 * @package Swift
 * @subpackage Mime
 * @author Chris Corbyn
 */
class Swift_Mime_EmbeddedFile extends Swift_Mime_Attachment
{

	/**
	 * Creates a new Attachment with $headers and $encoder.
	 * @param Swift_Mime_HeaderSet $headers
	 * @param Swift_Mime_ContentEncoder $encoder
	 * @param Swift_KeyCache $cache
	 * @param array $mimeTypes optional
	 */
	public function __construct(Swift_Mime_HeaderSet $headers, Swift_Mime_ContentEncoder $encoder, Swift_KeyCache $cache, $mimeTypes = array())
	{
		parent::__construct($headers, $encoder, $cache, $mimeTypes);
		$this->setDisposition('inline');
		$this->setId($this->getId());
	}

	/**
	 * Get the nesting level of this EmbeddedFile.
	 * Returns {@link LEVEL_RELATED}.
	 * @return int
	 */
	public function getNestingLevel()
	{
		return self::LEVEL_RELATED;
	}

}
