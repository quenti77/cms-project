## Toutes les informations pour améliorer le code

### Erreur d'inattention

Attention quand tu écris le code. Par exemple dans ton code, tu as :

```php
Class AccountAction{
}
```

Au lieu de :
```php
class AccountAction
{
}
```

Ou encore des noms de méthodes avec la première lettre en majuscule.

### Utilisation des fonctionnalités de PHP

Je te conseille [ce site](https://www.php.net/supported-versions) qui permet de suivre les versions de PHP.
Comme tu peux le voir, on devrait être en php 8.3 voir 8.4. Donc n'hésite pas à utiliser les nouveautés de PHP qui
améliore le code du projet.

Par exemple le typage de tes propriétés :
```php
class AccountAction
{
    public  $errors;
    private $app;
    private $cnx;
    private $validator;
    private $router;
    private $session;
}
```

Le typage va permettre de documenter le code sans forcément avoir besoin de commentaire.
Ce qui donne ceci :
```php
class AccountAction
{
    /** @var string[] $errors */
    public array $errors;
    private App $app;
    private Database $cnx;
    private Validator $validator;
    private Router $router;
    private Session $session;
}
```

On pourra même faire encore mieux avec l'injection de dépendances.

### Altorouter

Alors attention, car ce package n'est plus vraiment bon de nos jours. C'est pour cela que j'ai créé une version
plus récente, en gardant la simplicité :

- [Lien du code sur GitHub](https://github.com/quenti77/AlteRouter)
- [Lien de la doc](https://quenti77.github.io/AlteRouter-Docs/fr/)

*Il te faudra php en version 8.2 ou plus pour pouvoir l'utiliser.*

### Architecture du projet

Je te propose de revoir un peu ta structure en essayant de garder ce que tu avais voulu de base.

```
cms-project/
├── 📁 app/
│   ├── 📁 controllers/
│   ├── 📁 entities/
│   └── 📁 repositories/
├── 📁 config/
│   ├── app.php
│   └── database.php
├── 📁 public/
│   ├── 📁 scripts/
│   ├── 📁 styles/
│   ├── index.php
│   └── robots.txt
└── 📁 src/
    ├── 📁 DI/
    └── ...
```
