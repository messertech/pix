# Messer Pix

[<img src="https://badgen.net/badge/Powered%20by/Gustavo Ramad Messer/red" />](https://github.com/Goldbach07/)
[<img src="https://badgen.net/badge/Developed%20for/PHP/blue" />](https://www.php.net/)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

This is a library developed by Gustavo Ramad Messer for Symfony with the goal of generating random Pix keys in image and text formats (Pix copy and paste), using the open source gerarqrcodepix API.

## Installation

Use the composer to install:

```bash
composer require messer/pix
```

## Usage

Using Messer Pix to get a pix string key.

```PHP
use Messer\Pix\Pix;

$pix = new Pix();

$data = [
    'name' => 'Gustavo Ramad Messer',
    'city' => 'Santos',
    'key' => 'gustavoramadmesser',
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
    'name' => 'Gustavo Ramad Messer', // required
    'city' => 'Santos', // required
    'key' => 'gustavoramadmesser', // required
    'value' => '77.77', // optional
    'description' => 'Pix Image Test', // optional
    'output' => 'image', // optional (default: string)
    'destiny' => '', // optional (public path)
];

$pixResponse = $pix->generate($data);
```
## License
[MIT](https://choosealicense.com/licenses/mit/)

Copyright © 2023 [Gustavo Ramad Messer](https://github.com/messertech/pix/blob/main/LICENSE)

