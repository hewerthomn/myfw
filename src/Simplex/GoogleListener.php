<?php

namespace Simplex;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* 	Google Listener
*/
class GoogleListener implements EventSubscriberInterface
{
	
	public function onResponse(ResponseEvent $event)
	{
		$response = $event->getResponse();
		$headers = $response->headers;

		if ($response->isRedirection()
			|| (!$headers->has('Content-Type') && false == strpos($headers->get('Content-Type'), 'html'))
			|| 'html' !== $event->getRequest()->getRequestFormat()
		) {
			return;
		}

		$response->setContent($response->getContent() . 'GA CODE');
	}

	public static function getSubscribedEvents()
	{
		return ['response' => 'onResponse'];
	}
}