### Site peintre

site peintre est un site web qui presente des peintures

### Environement de developpement
## pre-requis

- PHP 8
- Maildev 
- Composer
- NodeJS et npm
  
### Lancer l'environement de developpement

``` bash
composer install
npm install
npm run build
npm run dev-server
php -S localhost:8081 -t public 
```
### Ajouter des donnees de tests

``` bash
php bin/console doctrine:fixtures:load
```


## Lancer des tests

``` bash
php bin/phpunit --testdox  
```

## Production

## Envoyer des mails

les mail de prise de contact sont stoquer en DB, pour les envoyer au Peintre par mail il faut
executer la commande suivante.

``` bash
php bin/console app:send-email
```