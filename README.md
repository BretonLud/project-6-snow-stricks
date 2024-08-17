# project-6-snow-tricks

### Prérequis

***

Installer docker

### Installation du projet

***

Pour commencer on clone le projet:

<pre><code><strong>git clone git@github.com:BretonLud/project-6-snow-tricks.git
</strong></code></pre>

Ensuite il faut se rendre dans le dossier du projet

```
cd project-6-snow-tricks
```

Créer un fichier la racine du projet .env.local

```
touch .env.local
```

Paramétrer les variables d'environnement avec vos informations: (le smtp paramétré est celui de MailHog)

```
MARIADB_USER=username
MARIADB_PASSWORD=password
MARIADB_ROOT_PASSWORD=root
MAILER_DSN=smtp://mailer:1025
DATABASE_URL="mysql://username:password@database:3306/snowtricks
```

Lancer les containers docker avec les 2 commandes suivantes :

```
 docker compose build
 docker compose up -d
```

Insérer les données dans la base de données juste en changeant l'username et le password :

```
docker exec -i snowtricks_database /usr/bin/mariadb -u username --password=password snowtricks < dump.sql
```

Amusez vous ensuite :)
