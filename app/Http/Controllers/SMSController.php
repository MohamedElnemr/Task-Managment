<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Infobip\Api\SendSmsApi;
use Infobip\Configuration;
use Infobip\Model\SmsAdvancedTextualRequest;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;

class SMSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function send_sms()
    {
        $BASE_URL = "https://vjlgp1.api.infobip.com";
        $API_KEY = "b9d0b450a43a5918361caabb38416a78-7b63c783-911e-42b3-af92-c466fc1972dc";

        $SENDER = "InfoSMS";
        $RECIPIENT = "201229213348";
        $MESSAGE_TEXT = "Hello Tiger";

        $configuration = (new Configuration())
                ->setHost($BASE_URL)
                ->setApiKeyPrefix('Authorization', 'App')
                ->setApiKey('Authorization', $API_KEY);

        $client = new Client();

        $sendSmsApi = new SendSMSApi($client, $configuration);
        $destination = (new SmsDestination())->setTo($RECIPIENT);
        $message = (new SmsTextualMessage())
                ->setFrom($SENDER)
                ->setText($MESSAGE_TEXT)
                ->setDestinations([$destination]);

$request = (new SmsAdvancedTextualRequest())->setMessages([$message]);

try {
    $smsResponse = $sendSmsApi->sendSmsMessage($request);
    echo ("Response body: " . $smsResponse);
} catch (Throwable $apiException) {
    echo("HTTP Code: " . $apiException->getCode() . "\n");
    echo ("Response body: " . $apiException->getResponseBody() . "\n");
}
    }
}
