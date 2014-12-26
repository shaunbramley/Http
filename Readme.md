This library is an attempt to re-create the functionality of the Goutte library without the requirement of Symfony's HttpFoundation.

Bramley\Http\Client extends the functionality of Guzzle through composition to enable it to be able to submit forms.


To ensure that Bramley\Http\Client maintains 100% feature complatibility with Guzzle the GuzzleHttp\ClientTest was modified to use Bramley\Http\Client.

Goutte can be found at: https://github.com/FriendsOfPHP/Goutte

Guzzle can be found at: https://github.com/guzzle/guzzle