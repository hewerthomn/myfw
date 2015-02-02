<?php

namespace Simplex;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* ContentLenght Listener
*/
class ContentLengthListener implements EventSubscriberInterface
{
	public function onResponse(ResponseEvent $event)
	{
		$response = $event->getResponse();
		$headers = $response->headers;

		if(!$headers->has('Content-Length') && !$headers->has('Transfer-Encoding')) {
			$headers->set('Content-Length', strlen($response->getContent()));
		}
	}

	public static function getSubscribedEvents()
	{
		return ['response' => ['onResponse', -255]];
	}
}