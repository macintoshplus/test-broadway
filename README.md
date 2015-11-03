test-broadway with state pattern
================================

[POC] Broadway 0.8.0 in symfony2 (2.7.x) project.

[Related article in english](http://nahan.fr/broadway-design-pattern-state/).
[Article en lien avec cet exemple (français)](http://nahan.fr/ddd-avec-broadway-et-le-design-pattern-state/).

If you want help me, fork and pull request or if you have already a fonctional example using MySQL Db for readmodel over Broadway, contact me.

> Note : Use the tag name `command_handler` in service configuration for all your commande handler. See `src/Jb/TestBundle/Ressources/config/service.yml` in this repository.


Install
=======

### Install vendor

```bash
composer install
```

### Init event-store table

Set db connection before execute this command.

```bash
app/console broadway:event-store:schema:init
```

> The broadway/broadway library is very easy to use. I use only event_store in my first test but the simplicity of implementation of this part is encouraging.

### Init ReadModel

For use the Doctrine ReadModel, init schema with this command :

```bash
app/console doctrine:migrations:migrate --em=readmodel
```

### Publish asset

```bash
app/console assets:install
```

Use
===

### Start server

You can use the integrated server :

```shell
php app/console server:start
``
Open browser and write this url : `http://127.0.0.1:8000`

### Login

Go to URL `<URL>/login`
Fill form with user and password present in login page.

### Create and update

Open browser and access to this url `<URL>/make/<texte>` for create a aggregate.

For update, use this url `<URL>/update/<UUID>/<texte>`
> For get the uuid, read in event_store table with MySQL Client.

### Lock and unlock

For lock, use this url `<URL>/lock/<UUID>`
> For get the uuid, read in event_store table with MySQL Client.

For unlock, use this url `<URL>/unlock/<UUID>`
> For get the uuid, read in event_store table with MySQL Client.




