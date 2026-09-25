<p align="center">
  <a href="https://shop.freshapp.io">
    <img src="docs/brand/freshapp-io-logo.png" alt="FreshApp.io" width="280">
  </a>
</p>

<p align="center">
  <a href="#francais">🇫🇷 Français</a> · <a href="#english">🇬🇧 English</a>
</p>

---

<a id="francais"></a>
## 🇫🇷 Français

# FreshApp PrettyBlocks

Blocs supplémentaires pour le module **PrettyBlocks**.

- **Nom technique** : `freshappprettyblocks`
- **Version** : 1.3.3
- **Auteur** : FreshApp.io
- **Dépendance** : le module `prettyblocks` doit être installé

### Blocs fournis

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

### Architecture

Code namespacé `FreshAppPrettyBlocks\` sous `src/`, chargé par un autoloader PSR-4
minimal dans `vendor/autoload.php`.

**Ce fichier `vendor/autoload.php` est du code source écrit à la main**, pas une
dépendance Composer : il doit être versionné. Le module n'embarque aucune
machinerie Composer.

### Hooks

`ActionRegisterBlock`, `displayHeader`.

Retrouvez nos modules sur **[shop.freshapp.io](https://shop.freshapp.io)**.

---

<a id="english"></a>
## 🇬🇧 English

# FreshApp PrettyBlocks

Extra blocks for the **PrettyBlocks** module.

- **Technical name**: `freshappprettyblocks`
- **Version**: 1.3.3
- **Author**: FreshApp.io
- **Dependency**: the `prettyblocks` module must be installed

### Blocks provided

| Block | Purpose |
|---|---|
| `FreshSpacer` | Adjustable vertical spacing |
| `FreshSeparator` | Separator rule |
| `FreshButton` | Button with label, link and style |
| `FreshGoogleMap` | Embedded Google Map |
| `FreshVideo` | Video player |
| `FreshTabs` | Tabbed content |
| `FreshHtmlCode` | Free HTML block |

Blocks register themselves with PrettyBlocks through the `ActionRegisterBlock` hook.

### Architecture

Namespaced code under `FreshAppPrettyBlocks\`, in `src/`, loaded by a minimal PSR-4
autoloader in `vendor/autoload.php`.

**This `vendor/autoload.php` file is hand-written source code**, not a Composer
dependency: it must be kept under version control. The module ships no Composer
tooling of its own.

### Hooks

`ActionRegisterBlock`, `displayHeader`.

Find our modules on **[shop.freshapp.io](https://shop.freshapp.io)**.

---

## Licence / License

GPL-3.0-or-later — voir / see [LICENSE](LICENSE).
