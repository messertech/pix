# Messer Pix

This is a library developed by Gustavo Messer for Symfony with the goal of generating random Pix keys in image and text formats (Pix copy and paste), using the open source gerarqrcodepix API.

## Examples

Using Messer Pix to get a pix string key.

```PHP
use Messer\Pix\Pix;

$pix = new Pix();

$data = [
    'name' => 'Gustavo Messer',
    'city' => 'Santos',
    'key' => 'gustavomesser',
    'value' => '77.77',
    'description' => 'Pix String Test',
    'output' => 'string', // optional (default: string)
    'destiny' => '', // optional (public path)
];

$pixResponse = $pix->generate($data);
```

Using Messer Pix to get a pix qr code image.

```PHP
use Messer\Pix\Pix;

$pix = new Pix();

$data = [
    'name' => 'Gustavo Messer', // required
    'city' => 'Santos', // required
    'key' => 'gustavomesser', // required
    'value' => '50.90', // optional
    'description' => 'Pix Image Test', // optional
    'output' => 'image', // optional (default: string)
    'destiny' => '', // optional (public path)
];

$pixResponse = $pix->generate($data);
```
