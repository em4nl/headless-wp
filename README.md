# Headless WP

This is a plugin for 'headless' use of WordPress, e.g. with a static site generator or separate frontend.

It stops WordPress from displaying any frontend page and optionally redirects all frontend requests to a URL of your choice. Also optionally, it runs a custom command or calls a webhook everytime a post in WordPress is saved (= everytime content is changed); Advanced Custom Fields aware!

## Installation

```sh
PATH_TO_YOUR_WORDPRESS='...'
git clone https://github.com/em4nl/headless-wp.git "${PATH_TO_YOUR_WORDPRESS}/wp-content/plugins/em4nl-headless-wp"
```

In WordPress, go to *Plugins* and activate it.

## Options

You should now have a menu entry under *Settings*, called *Headless WP*.

### Command or Webhook

Either a command line or the URL of a webhook to run on save_post (and acf/save_post, if ACF is installed). Leave blank to do nothing (e.g. if you have a dynamic frontend or you rebuild your static site periodically via cronjobs).

### Is Webhook

Tick this box if you supplied a webhook URL to the field above.

### Redirect URL

If set, all frontend requests will be redirected with a `302 Found` status to the given URL.

### Redirect is permanent

Check this to change the above to a `301 Moved Permanently`.

## Credit

A few lines in this plugin were inspired by [an article](https://roots.io/routing-wp-requests/) by [Giuseppe Mazzapica](https://github.com/gmazzap).

## License: MIT

Copyright 2018 Emanuel Tannert <post@etannert.de>

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
