### About

hCaptcha extension for phpBB.

[![Build Status](https://img.shields.io/github/workflow/status/AlfredoRamos/phpbb-ext-hcaptcha/CI?style=flat-square)](https://github.com/AlfredoRamos/phpbb-ext-hcaptcha/actions)
[![Latest Stable Version](https://img.shields.io/github/tag/AlfredoRamos/phpbb-ext-hcaptcha.svg?label=stable&style=flat-square)](https://github.com/AlfredoRamos/phpbb-ext-hcaptcha/releases)
[![Code Quality](https://img.shields.io/codacy/grade/880e827356774dcf8348b803ff5b6855.svg?style=flat-square)](https://app.codacy.com/gh/AlfredoRamos/phpbb-ext-hcaptcha/dashboard)
[![Translation Progress](https://badges.crowdin.net/phpbb-ext-hcaptcha/localized.svg)](https://crowdin.com/project/phpbb-ext-hcaptcha)
[![License](https://img.shields.io/github/license/AlfredoRamos/phpbb-ext-hcaptcha.svg?style=flat-square)](https://raw.githubusercontent.com/AlfredoRamos/phpbb-ext-hcaptcha/master/license.txt)

Adds [hCaptcha](https://hcaptcha.com) as a new CAPTCHA plugin for the **Spambot countermeasures** in the Administration Control Panel.

hCaptcha displays a checkbox similar to reCAPTCHA, but offers enhanced privacy, rewards for challenges, works in countries where Google reCAPTCHA is blocked and it allows website administrator to change the CAPTCHA difficulty through hCaptcha website.

### Features

- Protects user privacy
- Rewards websites
- It allows to change the widget theme and size
- It works on countries where reCAPTCHA is blocked
- You can change the difficulty of the challenges by site
- It's compatible with other extensions that displays CAPTCHAs such as **Contact Admin**

### Preview

[![Spambot countermeasures](https://i.imgur.com/R4RcI3Qb.png)](https://i.imgur.com/R4RcI3Q.png)
[![hCapcha configuration button](https://i.imgur.com/C1eI18wb.png)](https://i.imgur.com/C1eI18w.png)
[![hCaptcha configuration](https://i.imgur.com/EmYYpkZb.png)](https://i.imgur.com/EmYYpkZ.png)
[![hCaptcha plugin selection](https://i.imgur.com/iEkJYkKb.png)](https://i.imgur.com/iEkJYkK.png)
[![Board registration preview](https://i.imgur.com/gZ3BSDRb.png)](https://i.imgur.com/gZ3BSDR.png)
[![Board registration solving captcha](https://i.imgur.com/GgPNhdub.png)](https://i.imgur.com/GgPNhdu.png)
[![hCaptcha with alternative theme and size](https://i.imgur.com/GIJUXfDb.png)](https://i.imgur.com/GIJUXfD.png)
[![Integration with Contact Admin extension](https://i.imgur.com/OodqnUob.png)](https://i.imgur.com/OodqnUo.png)

*(Click to view in full size)*

### Requirements

- PHP 7.1.3 or greater
- phpBB 3.3 or greater
- hCaptcha site key and account secret key

### Support

- [**Download page**](https://github.com/AlfredoRamos/phpbb-ext-hcaptcha/releases)
- [GitHub issues](https://github.com/AlfredoRamos/phpbb-ext-hcaptcha/issues)
- [Crowdin translations](https://crowdin.com/project/phpbb-ext-hcaptcha)

### Donate

If you like or found my work useful and want to show some appreciation, you can consider supporting its development by giving a donation.

[![Donate with PayPal](https://alfredoramos.mx/images/paypal.svg)](https://alfredoramos.mx/donate/) | [![Donate with Stripe](https://alfredoramos.mx/images/stripe.svg)](https://alfredoramos.mx/donate/)
:-:|:-:
[![Donate with PayPal](https://alfredoramos.mx/images/donate_paypal.svg)](https://alfredoramos.mx/donate/) | [![Donate with Stripe](https://alfredoramos.mx/images/donate_stripe.svg)](https://alfredoramos.mx/donate/)

### Installation

- Download the [latest release](https://github.com/AlfredoRamos/phpbb-ext-hcaptcha/releases)
- Decompress the `*.zip` or `*.tar.gz` file
- Copy the files and directories inside `{PHPBB_ROOT}/ext/alfredoramos/hcaptcha/`
- Go to your `Administration Control Panel` > `Customize` > `Manage extensions`
- Click on `Enable` and confirm

### hCaptcha

In order to use hCaptha on your phpBB board, you need to generate a site key and copy your account secret key.

To do so, go to [www.hcaptcha.com](https://hcaptcha.com) and sign up if you don't have an account already.

> :loudspeaker: **Note:** Click on the following images to see them in full size.

Once logged in, go to [Sites](https://dashboard.hcaptcha.com/sites) and add a new site or click on the `Settings` button.

[![hCaptcha site key settings](https://i.imgur.com/Iq5mGU3l.png)](https://i.imgur.com/Iq5mGU3.png)

Add a descriptive site name and **copy the site key** shown.

[![hCaptcha site key](https://i.imgur.com/u63owgPl.png)](https://i.imgur.com/u63owgP.png)

Further down, you can optionally add your hostnames where you want to show the widget, and change the difficulty of the CAPTCHAs.

[![hCaptcha Captcha difficulty](https://i.imgur.com/pINqYqcl.png)](https://i.imgur.com/pINqYqc.png)

Now, you need to go to your account [Settings](https://dashboard.hcaptcha.com/settings) and **copy the secret key** shown.

[![hCaptcha account secret key](https://i.imgur.com/nsdTHFul.png)](https://i.imgur.com/nsdTHFu.png)

### Configuration

- Login to your phpBB `Administration Control Panel`
- Go to `General` > `Board configuration` > `Spambot countermeasures`
- Go to the section `Available plugins` and choose `hCaptcha` in the `Installed plugins` menu
- Click on the `Configure` button
- Paste the site key in the `Site key` field
- Paste the account secret key in the `Secret key` field
- Optionally choose a theme and size of the generated widget
- Click on `Submit` to save the configuration changes

### Uninstallation

- Go to your `Administration Control Panel` > `Customize` > `Manage extensions`
- Click on `Disable` and confirm
- Go back to `Manage extensions` > `hCaptcha` > `Delete data` and confirm

### Upgrade

- Go to your `Administration Control Panel` > `Customize` > `Manage extensions`
- Click on `Disable` and confirm
- Delete all the files inside `{PHPBB_ROOT}/ext/alfredoramos/hcaptcha/`
- Download the new version
- Upload the new files inside `{PHPBB_ROOT}/ext/alfredoramos/hcaptcha/`
- Enable the extension again
