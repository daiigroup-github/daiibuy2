<?php
/*
 * This file is part of SwiftMailer.
 * (c) 2004-2009 Chris Corbyn
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

//@require 'Swift/Mime/Message.php';
//@require 'Swift/Events/EventListener.php';

/**
 * Sends Messages via an abstract Transport subsystem.
 *
 * @package Swift
 * @subpackage Transport
 * @author Chris Corbyn
 */
interface Swift_Transport
{

	/**
	 * Test if this Transport mechanism has started.
	 *
	 * @return boolean
	 */
	public function isStarted();

	/**
	 * Start this Transport mechanism.
	 */
	public function start();

	/**
	 * Stop this Transport mechanism.
	 */
	public function stop();

	/**
	 * Send the given Message.
	 *
	 * Recipient/sender data will be retreived from the Message API.
	 * The return value is the number of recipients who were accepted for delivery.
	 *
	 * @param Swift_Mime_Message $message
	 * @param string[] &$failedRecipients to collect failures by-reference
	 * @return int
	 */
	public function send(Swift_Mime_Message $message, &$failedRecipients = null);

	/**
	 * Register a plugin in the Transport.
	 *
	 * @param Swift_Events_EventListener $plugin
	 */
	public function registerPlugin(Swift_Events_EventListener $plugin);
}
