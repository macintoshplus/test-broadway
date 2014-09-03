test-broadway
=============

Attempt use Broadway in symfony2 project.


After success using broadway with elasticsearch. Attempt to use a readmodel in MySQL DB.

If you want help me, fork and pull request or if you have already a fonctional example using MySQL Db for readmodel over Broadway, contact me.

> Note : Use the tag name `command_handler` in service configuration for all your commande handler. See `src/Jb/TestBundle/Ressources/config/service.yml` in this repository.


Install
=======

Install vendor :

```bash
composer install
```

Init event-store table. Set db connection before execute this command.

```bash
app/console broadway:event-store:schema:init
```

> The broadway/broadway library is very easy to use. I use only event_store in my first test but the simplicity of implementation of this part is encouraging.







