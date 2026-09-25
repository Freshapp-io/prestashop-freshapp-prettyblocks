# FreshApp PrettyBlocks

Blocs supplémentaires pour le module **PrettyBlocks**.

- **Nom technique** : `freshappprettyblocks`
- **Version** : 1.0.0
- **Auteur** : FreshApp.io
- **Dépendance** : le module `prettyblocks` doit être installé

## Blocs fournis

| Bloc | Rôle |
|---|---|
| `FreshSpacer` | Espacement vertical réglable |
| `FreshSeparator` | Filet de séparation |
| `FreshButton` | Bouton avec libellé, lien et style |
| `FreshGoogleMap` | Carte Google Maps intégrée |
| `FreshVideo` | Lecteur vidéo |
| `FreshTabs` | Contenu en onglets |
| `FreshHtmlCode` | Bloc HTML libre |

Les blocs s'enregistrent auprès de PrettyBlocks via le hook `ActionRegisterBlock`.

## Architecture

Code namespacé `FreshAppPrettyBlocks\` sous `src/`, chargé par un autoloader PSR-4
minimal dans `vendor/autoload.php`.

**Ce fichier `vendor/autoload.php` est du code source écrit à la main**, pas une
dépendance Composer : il doit être versionné. Le module n'embarque aucune
machinerie Composer.

## Hooks

`ActionRegisterBlock`, `displayHeader`.

## Licence

GPL-3.0-or-later — voir le fichier [LICENSE](LICENSE).
