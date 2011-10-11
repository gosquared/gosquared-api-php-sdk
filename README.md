### PHP SDK for GoSquared API

This is a quick and simple SDK for use in PHP applications.

####Usage

First of all, add your api key for your sites into config.php.

Function names in the SDK directly mirror those on the GoSquared API.

You may supply an associative array of additional parameters to send to
the API function, as per documented on the function's documentation
page.

Example:

```php
$site_token = 'GSN-123456-X';
$sdk = new gosquared\sdk($site_token);
$response = $g->visitors(array(
    'visitorsLimit' => 5 // Limit the number of returned visitors to 2
));
```

The function returns an stdClass object with the API response. Sample
response:

    object(stdClass)#17 (1) {
      ["aggregateStats"]=>
      object(stdClass)#18 (5) {
        ["organisations"]=>
        object(stdClass)#19 (6) {
          ["Comcast Cable"]=>
          int(4)
          ["Verizon Internet Services"]=>
          int(3)
          ["Ver TV S.A."]=>
          int(1)
          ["VTR Banda Ancha S.A."]=>
          int(1)
          ["TPG Internet Pty Ltd."]=>
          int(1)
          ["other"]=>
          int(13)
        }
        ["platforms"]=>
        object(stdClass)#20 (5) {
          ["mac107"]=>
          int(8)
          ["winxp"]=>
          int(5)
          ["mac106"]=>
          int(5)
          ["win7"]=>
          int(4)
          ["mac105"]=>
          int(1)
        }
        ["languages"]=>
        object(stdClass)#21 (6) {
          ["en-us"]=>
          int(16)
          ["fr"]=>
          int(2)
          ["sr"]=>
          int(1)
          ["pt-br"]=>
          int(1)
          ["es-es"]=>
          int(1)
          ["other"]=>
          int(2)
        }
        ["countries"]=>
        object(stdClass)#22 (6) {
          ["US"]=>
          int(12)
          ["TN"]=>
          int(1)
          ["RS"]=>
          int(1)
          ["GB"]=>
          int(1)
          ["FR"]=>
          int(1)
          ["other"]=>
          int(7)
        }
        ["browsers"]=>
        object(stdClass)#23 (4) {
          ["chrome"]=>
          int(10)
          ["safari"]=>
          int(6)
          ["firefox"]=>
          int(5)
          ["applewebkit"]=>
          int(2)
        }
      }
    }
