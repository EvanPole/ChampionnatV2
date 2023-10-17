# APP Championnat


## Installation

### initier le projet

- Modifier les lignes suivantes du fichier .env :
```json 
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

- Executer la migration
`artisan migrate:install`
- Faire la migration des nouvelles tables
`artisan migrate`

### commandes a effectuer pour les seeder 


- `artisan db:seed --class=EquipeSeeder`

- `artisan db:seed --class=JoueurSeeder`

- `artisan db:seed --class=MatcheSeeder`


### commandes Tinker pour les permissions

## crée les roles
- `use Silber\Bouncer\Database\Role;`
- `Role::create(['name' => 'administrateur']);`
- `Role::create(['name' => 'arbitre']);`
## Donnée des acces a un utilisateur 

- `use Bouncer;`
### Ajouter un role a votre utilisateur
- `$user = User::find(1);`
- `Bouncer::assign('admin')->to($user);`
