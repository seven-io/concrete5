<p align="center">
  <img src="https://www.seven.io/wp-content/uploads/Logo.svg" width="250" alt="seven logo" />
</p>

<h1 align="center">seven SMS for concrete5</h1>

<p align="center">
  Send SMS and text-to-speech calls to your <a href="https://www.concrete5.org/">concrete5</a> users via the seven gateway.
</p>

<p align="center">
  <a href="LICENSE"><img src="https://img.shields.io/badge/License-MIT-teal.svg" alt="MIT License" /></a>
  <img src="https://img.shields.io/badge/concrete5-9.x-blue" alt="concrete5 9.x" />
  <img src="https://img.shields.io/badge/PHP-8.0%2B-purple" alt="PHP 8.0+" />
  <a href="https://packagist.org/packages/seven.io/concrete5"><img src="https://img.shields.io/packagist/v/seven.io/concrete5" alt="Packagist" /></a>
</p>

---

## Features

- **User Phone Attribute** - Adds a `phone` user attribute that drives all messaging features
- **SMS & Voice** - Send single or bulk SMS plus text-to-speech calls
- **Composer-First Install** - Standard concrete5 package install via Composer

## Prerequisites

- concrete5 9.x (Composer-based install)
- PHP 8.0+
- A [seven account](https://www.seven.io/) with API key ([How to get your API key](https://help.seven.io/en/developer/where-do-i-find-my-api-key))

## Installation

```bash
cd path/to/concrete5/root
composer require seven.io/concrete5
```

In the concrete5 dashboard, navigate to **Extend concrete5 > Add Functionality** and click **Install** next to the *seven* package.

## Configuration

After install, open the seven dashboard page in concrete5 admin and paste your API key. The phone user attribute is automatically registered - users can fill it in their profile.

## Support

Need help? Feel free to [contact us](https://www.seven.io/en/company/contact/) or [open an issue](https://github.com/seven-io/concrete5/issues).

## License

[MIT](LICENSE)
