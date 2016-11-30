# Contenu du dépot

Une branche par élèves par projet  
La branche master contient la correction  
Version: Symfony 2.8

#### Pré-requis
1. [Composer](https://getcomposer.org/)
2. Serveur local  
	* Apache  
	* Serveur symfony: php appp/console server:run

#### Process install
```
composer install
php app/console doctrine:database:create
php app/cosnole doctrine:schema:update --force
php app/console assets:install
```

# Enoncé:

=========================

> Les points 11/12/13 peuvent être réalisés dans l'ordre que tu le souhaites.  
> Une fois le mini-projet terminé, connecte toi à github avec tes identifiants.
> Créé un repository, nomme le avec ton prénom, et selectionne le Owner "wcsfontainebleau".  
> Dépose le travail que tu as effectué sur github  
> Redige un mini readme  

========================

#### 1. Créer un projet Symfony v2.8

#### 2. Supprimer l'AppBundle et créer un Bundle nommé Média

#### 3. Créer une entité:
```
- Album
	- titre_album, type string, lenght 255, non null
	- artiste, type string, lenght 255, non null
	- genre, type string, lenght 255, non null
	- support, type string, lenght 255, non null
```

#### 4. Créer les actions permettant de voir, créer, éditer, et supprimer un Album.
La page index doit etre consultable avec le path "/".  
`Exemple: http://localhost/name_project/web/app_dev.php/`

#### 5. Lors de la création d'un album: 
- Nous avons le choix entre 3 genres sous forme de menu déroulant, Hiphop, Soul et Rock.
- Nous avons le choix entre 3 supports sous forme de menu déroulant, Vinyl, CD, Cassette.  
**Hint** ==> [ChoiceType With Symfony](http://symfony.com/doc/current/reference/forms/types/choice.html)

#### 6. Faire une mise en page simple de l'index et du formulaire de création

#### 7. Créer une entitée:
```
- Commentaire
	- utilisateur, type string, lenght 255, non null
	- commentaire, type text, non null
```

#### 8. Faire une relation oneToMany afin de pouvoir associer des commentaires à un album
 
#### 9. Nous devons pouvoir créer un commentaire et le supprimer, pas de méthode d'édit.

#### 10. L'utilisateur doit avoir la possibilité de ne pas renseigner son nom d'utilisateur, si c'est le cas, ce dernier sera enregistré automatiquement avec la valeur "Anonyme".

#### 11. L'affichage des commentaires se fera sous l'album que l'on visualise (page show).

#### 12. Ajouter la possibilité d'uploader la photo de l'album

#### 13. Sur la page d'index, on aura la possibilité d'afficher uniquement les albums d'un genre choisi, via un mini formulaire de recherche.

#### 14. Sur la page permettant de visualiser un album, mettre le formulaire permettant de laisser un commentaire sur l'album. Les commentaires doivent s'afficher sur la même page (page show).
