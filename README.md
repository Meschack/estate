# Bénin Immo - Comment ça fonctionne ?

## Généralité

Le site est composé en général de deux parties. Une première partie pour les utilisateurs et une autre pour le(s) administrateur(s).

### Interface utilisateur

Cette partie comporte quatre parties principales : Une page d'`accueil`, un `catalogue`, une page `A Propos` et une page de `contact`

- Le catalogue présente sous forme de grille composée de carte, toutes les propriétés de l'agence. Sur les cartes, se trouvent quelques détails à propos de la propriété. Ces détails sont visibles dès qu'on survole la carte en mode Desktop et sont toujours visibles en mode Mobile.

  - Chaque carte contient un lien **En savoir plus** qui redirige sur une page qui donne plus de détails sur la propriété.

  - Sur cette page de présentation, il y a un bouton permettant de réserver la propriété en vue d'une négociation future. Lorsque le visteur n'est en revanche pas connecté, il y a un bouton qui lui indique qu'il pourrait se connecter pour réserver la propriété.

- La page de contact est une page sur laquelle l'utilisateur à la possibilité de laisser un message à l'administrateur du site. Mais avant de pouvoir accéder à cette page, l'utilisateur doit au préalable se connecter. La page de connexion contient également un bouton qui redirige vers la page d'inscription. Au cas où l'utilisateur n'aurait pas déjà un compte. Après la création du compte, l'utilisateur est redirigé vers la page de contact et son état de connexion de l'utilisateur est persisté aussi longtemps que durera la session.

### Interface d'administration

Cette partie n'est visible que par un tenant d'un compte d'administration. Elle comporte deux parties : une partie de `gestion de la base de donnée` et une partie présentant toutes les `pages du site`. Elle est aussi dotée d'une **barre de navigation** qui continent un centre de message qui recense tous les messages qui ont été envoyés par les utilisateurs par le biais de la page de contact

- La partie de gestion de la base de données contient un sous-menu qui contient trois liens :

  - _Lien vers la partie de gestion des propriétés_
    Ce lien redirige vers une page sur laquelle l'administrateur pourra ajouter une nouvelle propriété en remplissant un formulaire. Lorsque le formulaire est soumis, les informations sont récupérées et envoyées dans la base de données.

    Sur cette même page, se trouve une table qui matérialise en quelque sorte la base de données. Cette table contient toutes les propriétés et leur caractéristique dans la base de données. L'administrateur pourra, par son bias, supprimer une propriété de la base de données s'il le désire.

  - _Lien vers la partie de gestion des utilisateurs_
    Ici, l'administrateur pourra surtout ajouter un nouvel administrateur au site. Celui ci pourra donc avec ses identifiants, avoir accès à la partie d'administration.

    Cette page contient aussi une table qui recense tous les utilisateurs du site avec leurs caractéristiques dans la base de données. Cette table a été réalisé à l'aide d'une bibliothèque Javascript **DataTables** qui intègre des fonctionnalités comme de la pagination, recherche dans la table... L'administrateur aura également la possibilité ici, de supprimer le compte d'un utilisateur.

  - _Lien vers la partie de gestion des informations de l'agence_
    Ici, l'administrateur pourra tout simplement mettre à jour les informations de l'agence.

## Composants

Le site possède une base de données qui contient quatre tables. Une table `properties` qui contient toutes les propriétés et leurs caractéristiques, une table `users` qui contient tous les utilsateurs du site avec leurs informations, une table `message` qui recense tous les messages postés sur le site en plus des souhaits de réservation de propriété et une table `agency-infos` qui contient toutes les informations relatives à l'agence.

**⚠️ IMPORTANT 💥: Pour les tests, j'ai créé deux comptes :**

1. Compte utilisateur

   Adresse Email : [meshachgbewezoun@gmail.com](meshachgbewezoun@gmail.com)

   Mot de passe : Aaaaaa04

2. Compte administrateur

   Adresse Email : john@doe.com

   Mot de passe : compteDoe04
Vous pouvez voir le site en live via [ce lien](http://www.benin-immo.great-site.net)

**Réalisé par Meschack Gbewezoun, Etudiant en Informatique de Gestion**
