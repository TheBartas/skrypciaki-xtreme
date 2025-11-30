# skrypciaki-xtreme


# Informacje i instrukcja obsługi Git
## [1] Praca na własnej gałęzi
Każdy pracuje **wyłącznie na swojej gałęzi** (branch), której nazwa jest **identyczna z Waszym indeksem**. Przed rozpoczęciem pracy zawsze upewnij się, że jesteś na właściwym branchu.
### Przełączanie się na swoją gałąź
```bash
git checkout <indeks>
```
### Wyświetlenie wszystkich gałęzi (ta, na której jesteście jest oznaczona *)
```bash
git branch
```
> **Uwaga:** Nigdy nie wykonujemy żadnych zmian bezpośrednio na gałęzi `main`!
---
## [2] Rozpoczęcie pracy
Po przełączeniu się na swoją gałąź należy pobrać najnowsze zmiany z `main` i scalić je:
```bash
git pull origin main
git merge main
```
### Teraz możesz pracować nad kodem
*(tu wykonujesz swoje zmiany)*
### Po zakończeniu pracy
Dodanie zmian:
```bash
git add .
```
Commit z opisem:
```bash
git commit -m "<komentarz>"
```
Wysłanie zmian na zdalne repozytorium:
```bash
git push origin <indeks>
```
---
## [3] Scalanie swojego brancha z `main`
```bash
git checkout main
git merge <indeks>
git push origin main
```






