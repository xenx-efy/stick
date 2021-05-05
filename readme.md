# WP boilerplate 

## Requirements

- [docker](https://docs.docker.com/get-docker/)
- [docker-compose](https://docs.docker.com/compose/install/)
- [lando](https://docs.lando.dev/basics/installation.html)

## Installation
1. Run `lando start` in project root directory;
2. Go into theme directory and run `lando composer install && lando npm install`;
3. Copy and rename `config.json.dist` into `config.json`.

## Xdebug

- `lando xdebug <mode>` - load [Xdebug](https://xdebug.org/) in the selected, run it for enable xdebug
  [mode(s)](https://xdebug.org/docs/all_settings#mode);
- In mapping configuration you should set servername and hostname as `appserver`, port `80`
  and set mapping on `web` directory as `/app/web`;
- For debugger listener set `9003` port.

> If debugger doesn't work, try to install and use [Xdebug helper](https://chrome.google.com/webstore/detail/xdebug-helper/eadndfjplgieldjbigjakmdgkmoaaaoc)
extension for your browser.
>
> Or make sure it is not blocked by the firewall.

**Source [link](https://github.com/lando/lando/issues/1668#issuecomment-772829423) on setup**