# 🏠 Colocation Management System

Application web développée avec **Laravel** permettant de gérer une colocation : membres, dépenses communes et balances entre colocataires.

## 📌 Description

Ce projet permet aux utilisateurs de créer ou rejoindre une colocation afin de gérer facilement les dépenses partagées entre les membres.

Chaque colocation possède :
- un **owner (propriétaire)**
- plusieurs **membres**
- des **dépenses partagées**
- un **système de balance** pour savoir qui doit payer qui.

L'application calcule automatiquement les parts de chaque membre et affiche les balances.

---

# ⚙️ Technologies utilisées

- **Laravel**
- **PHP**
- **PostgreSQL**
- **Blade**
- **TailwindCSS**
- **Docker (optionnel)**

---

# 📊 Fonctionnalités principales

## 👤 Gestion des utilisateurs
- Inscription et connexion
- Système d'authentification
- Réputation des utilisateurs

## 🏠 Gestion des colocations
- Créer une colocation
- Rejoindre une colocation
- Quitter une colocation
- Statut actif / inactif

## 👥 Gestion des membres
- Voir la liste des membres
- Rôle : **Owner / Member**
- Invitation de nouveaux membres

## 💰 Gestion des dépenses
- Ajouter une dépense
- Choisir le payeur
- Choisir la catégorie
- Répartir la dépense entre les membres

## 📈 Calcul des balances
Le système calcule automatiquement :

- Total des dépenses
- Part de chaque membre
- Montant payé par chaque utilisateur
- Balance finale

Exemple :

| Utilisateur | Payé | Doit | Balance |
|-------------|------|------|--------|
| Alice | 200€ | 100€ | +100€ |
| Bob | 50€ | 100€ | -50€ |

---

# 🧠 Logique de réputation

Si un membre quitte une colocation **alors qu'il a encore une dette**, sa réputation diminue.
