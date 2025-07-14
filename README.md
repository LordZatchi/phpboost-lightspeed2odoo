# Lightspeed2Odoo - Module PHPBoost 6.0

> Exportateur automatisé de données CSV de Lightspeed Série K vers Odoo POS

---

## 📦 Fonctionnalités

- Importation d’un fichier CSV complet de Lightspeed Série K
- Extraction automatique des champs nécessaires :
  - SKU
  - Nom
  - SKU parent
  - Type
  - Prix par défaut
  - Prix du supplément
  - Département
  - Menu/Écran
  - Nom du bouton
  - Couleur du bouton
- Export direct vers Odoo POS via API JSON-RPC
- Gestion des modèles d’export définis par un administrateur
- Interface utilisateur simple et intuitive
- Configuration de l’URL Odoo et clé API dans le back-office PHPBoost

---

## ⚙️ Installation

1. Copiez le dossier `lightspeed2odoo` dans `/phpboost/modules/`
2. Activez le module depuis l’administration PHPBoost
3. Configurez l’URL Odoo et la clé API dans le menu du module
4. Commencez à importer vos fichiers CSV

---

## 🛠 Développement

Ce module est conçu pour être modulaire, compatible VSCode, avec :
- Structure PHPBoost 6.0 standard
- Code commenté et versionné
- Prêt à être partagé via GitHub

---

## 🧑‍💻 Auteur

- **Victorien Berger** (alias [LordZatchi](https://github.com/LordZatchi))

---

## 📄 Licence

Ce projet est open-source sous licence MIT.
