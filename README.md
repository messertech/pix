# Pix by Gustavo Messer


## Examples

Using Messer Pix to get a pix qr code image.

```PHP
use Messer\Pix\Pix;

$pix = new Pix();

$data = [
    'name' => 'Gustavo Messer',
    'city' => 'Santos',
    'key' => 'gustavomesser',
    'value' => '50.90',
    'description' => 'Pix de teste',
    'output' => 'string',
    'destiny' => '',
];

$pixResponse = $pix->generate($data);
```

Using Messer Pix to get a pix string key.

```PHP
use Messer\Pix\Pix;

$pix = new Pix();

$data = [
    'name' => 'Gustavo Messer',
    'city' => 'Santos',
    'key' => 'gustavomesser',
    'value' => '50.90',
    'description' => 'Pix de teste',
    'output' => 'string',
    'destiny' => '',
];

$pixResponse = $pix->generate($data);
```
