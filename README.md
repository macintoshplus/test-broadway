test-broadway
=============

Attempt use Broadway in symfony2 project.


If you want help me, fork and pull request or if you have already a fonctional example using MySQL Db for readmodel over Broadway, contact me.

> Note : Use the tag name `command_handler` in service configuration for all your commande handler. See `src/Jb/TestBundle/Ressources/config/service.yml` in this repository.

> *Caution when updating the Broadway library. Several changes requires refactoring of part of the code.*

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

### Login
Go to URL `<URL>/login`
Fill form with user and password present in login page.

### Create and update

Open browser and access to this url `<URL>/make/<texte>` for create a aggregate.

For update, use this url `<URL>/update/<UUID>/<texte>`
> For get the uuid, read in event_store table with MySQL Client.




