# CompuTek - Projet AP2

Ce projet est une simulation d’un site e-commerce réalisée dans le cadre du BTS Services Informatiques aux Organisations (SIO). L'objectif était de concevoir un système de gestion de panier d’achats, d'afficher un récapitulatif de commande et de simuler le paiement via un formulaire classique.

## Fonctionnalités

- **Gestion du panier** :  
  Affichage des produits ajoutés avec leur quantité, leur prix unitaire et le calcul du total intermédiaire.

- **Calcul du récapitulatif** :  
  Calcul automatique du total intermédiaire, des frais de livraison, du total TTC, du total hors TVA et de la TVA.

- **Formulaire de paiement** :  
  Saisie des informations personnelles (nom, adresse, téléphone, email) et des informations de paiement avec une mise en forme automatique des entrées.

- **Simulation de paiement** :  
  Vérification que tous les champs du formulaire sont remplis et affichage d’un message de succès en cas de validation.

## Installation

1. Clonez le dépôt :
    ```bash
    git clone https://github.com/votre-utilisateur/computek.git
    ```
2. Placez le projet sur un serveur local (ex. XAMPP, WAMP, etc.) ou sur un hébergement compatible PHP.
3. Configurez une session PHP et initialisez la variable `$_SESSION['panier']`.
4. Accédez au projet via votre navigateur pour tester la simulation de commande et le formulaire de paiement.

## Utilisation

- **Ajout/gestion du panier** :  
  Le panier doit être initialisé au préalable. Chaque produit contient des informations telles que l’image, la marque, le modèle, le prix et la quantité.

- **Paiement** :  
  Remplissez le formulaire pour simuler le paiement. Une alerte JavaScript (par exemple via Swal.fire) confirmera la réussite de l’opération et redirigera l’utilisateur vers la page d’accueil.

> **Attention :** Ce projet est une simulation dans le cadre d’un travail scolaire. Aucun paiement réel n’est effectué et aucune donnée sensible n’est traitée.

## Personnalisation

- Vous pouvez adapter le style du formulaire et du récapitulatif de commande en modifiant les fichiers CSS inclus dans le projet.
- Les scripts JavaScript intégrés assurent le formatage automatique (numéro de téléphone, numéro de carte bancaire, date d’expiration, etc.). N’hésitez pas à les modifier selon vos besoins.

## Licence

Ce projet est distribué sous licence MIT. Voir le fichier [LICENSE](LICENSE) pour plus d’informations.
